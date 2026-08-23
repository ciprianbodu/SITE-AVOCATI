#!/usr/bin/env python3
"""Upload the redesigned site over FTP/FTPS without deleting remote files."""
from __future__ import annotations

import json
import os
import pathlib
import socket
import ssl
import sys
import time
from ftplib import FTP, FTP_TLS, error_perm

ROOT = pathlib.Path(__file__).resolve().parents[2]
SFTP_JSON = ROOT / "sftp.json"

UPLOAD_FILES = [
    "index.php",
    "en.php",
    "config.php",
    ".htaccess",
    "includes/.htaccess",
    "includes/index.php",
    "includes/bootstrap.php",
    "includes/i18n.php",
    "includes/mail.php",
    "includes/template.php",
    "assets/css/site.css",
    "assets/js/site.js",
    "assets/img/favicon.svg",
]

DIRS = [
    "includes",
    "assets",
    "assets/css",
    "assets/js",
    "assets/img",
]


def load_cfg() -> dict:
    raw = SFTP_JSON.read_text()
    depth = 0
    buf: list[str] = []
    for ch in raw:
        buf.append(ch)
        if ch == "{":
            depth += 1
        elif ch == "}":
            depth -= 1
            if depth == 0:
                break
    cfg = json.loads("".join(buf))
    return {
        "host": os.environ.get("FTP_HOST", cfg["host"]),
        "user": os.environ.get("FTP_USER", cfg["username"]),
        "password": os.environ.get("FTP_PASS", cfg["password"]),
        "port": int(os.environ.get("FTP_PORT", cfg.get("port", 21))),
    }


def connect(cfg: dict):
    last_err = None
    for use_tls in (False, True):
        try:
            if use_tls:
                ctx = ssl.SSLContext(ssl.PROTOCOL_TLS_CLIENT)
                ctx.check_hostname = False
                ctx.verify_mode = ssl.CERT_NONE
                ftp = FTP_TLS(context=ctx, timeout=45)
                ftp.connect(cfg["host"], cfg["port"])
                ftp.auth()
                ftp.login(cfg["user"], cfg["password"])
                ftp.prot_p()
            else:
                ftp = FTP(timeout=45)
                ftp.connect(cfg["host"], cfg["port"])
                ftp.login(cfg["user"], cfg["password"])
            ftp.set_pasv(True)
            ftp.sendcmd("TYPE I")
            print(f"connected {'ftps' if use_tls else 'ftp'} pwd={ftp.pwd()}")
            return ftp
        except Exception as exc:
            last_err = exc
            print(f"connect {'ftps' if use_tls else 'ftp'} failed: {type(exc).__name__}: {exc}")
    raise RuntimeError(f"FTP login failed: {last_err}")


def ensure_dir(ftp, path: str) -> None:
    try:
        ftp.mkd(path)
        print(f"mkdir {path}")
    except error_perm as exc:
        if "550" not in str(exc) and "exists" not in str(exc).lower():
            # 550 usually means already exists
            print(f"mkdir {path} note: {exc}")


def pret(ftp, cmd: str) -> None:
    try:
        ftp.sendcmd(f"PRET {cmd}")
    except Exception:
        pass


def upload_one(ftp, rel: str, retries: int = 4) -> None:
    local = ROOT / rel
    size = local.stat().st_size
    remote = rel.replace("\\", "/")
    last = None
    for attempt in range(1, retries + 1):
        try:
            pret(ftp, f"STOR {remote}")
            with local.open("rb") as fh:
                ftp.storbinary(f"STOR {remote}", fh, blocksize=8192)
            remote_size = ftp.size(remote)
            if remote_size != size:
                raise RuntimeError(f"size mismatch {remote}: local={size} remote={remote_size}")
            print(f"ok {remote} ({size} bytes)")
            return
        except Exception as exc:
            last = exc
            print(f"retry {attempt}/{retries} {remote}: {type(exc).__name__}: {exc}")
            time.sleep(2 * attempt)
            try:
                ftp.voidcmd("NOOP")
            except Exception:
                pass
    raise RuntimeError(f"failed {remote}: {last}")


def main() -> int:
    cfg = load_cfg()
    ftp = connect(cfg)
    try:
        for directory in DIRS:
            ensure_dir(ftp, directory)
        for rel in UPLOAD_FILES:
            upload_one(ftp, rel)
    finally:
        try:
            ftp.quit()
        except Exception:
            try:
                ftp.close()
            except Exception:
                pass
    print("sync complete")
    return 0


if __name__ == "__main__":
    try:
        sys.exit(main())
    except Exception as exc:
        print(f"FATAL {type(exc).__name__}: {exc}", file=sys.stderr)
        sys.exit(1)
