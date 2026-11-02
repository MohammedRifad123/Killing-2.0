# Killing: 2 — Insane CTF Machine

![Difficulty](https://img.shields.io/badge/Difficulty-Insane-red)
![OS](https://img.shields.io/badge/OS-Linux%20Ubuntu%2022.04-blue)
![Author](https://img.shields.io/badge/Author-Mohammed%20Rifad-green)
![Series](https://img.shields.io/badge/Series-Killing-orange)
![Docker](https://img.shields.io/badge/Built%20With-Docker-2496ED)

---

## 📖 Description

**Killing: 2** is the sequel to [Killing: 1](https://github.com/MohammedRifad123/killing-dark-access).

An **Insane-rated** boot-to-root CTF machine built for the cybersecurity community. It chains 7 attack techniques in sequence — no single step is enough. Every phase depends on the previous one.

> Built with Docker for easy deployment in any isolated lab environment.

---

## ⚔️ Attack Chain

```
[Recon] → [SSRF + AES Bypass] → [PHP UAF RCE] → [Binary RE]
       → [Network Pivot] → [Buffer Overflow] → [Docker Escape] → [Root]
```

---

## 🎯 Difficulty Breakdown

| # | Phase | Technique | Difficulty |
|---|-------|-----------|------------|
| 1 | Reconnaissance | Nmap + ffuf enumeration | Medium |
| 2 | SSRF | Gopher:// scheme + AES crypto bypass | Hard |
| 3 | RCE | PHP Use-After-Free (UAF) heap spray | Insane |
| 4 | Reverse Engineering | Custom binary analysis with Ghidra | Hard |
| 5 | Network Pivot | Internal network via Chisel tunnel | Hard |
| 6 | Privilege Escalation | Stack Buffer Overflow ret2libc (32-bit) | Insane |
| 7 | Root | Docker socket escape to host filesystem | Hard |

---

## 🚩 Flags

| Flag | Location | Value |
|------|----------|-------|
| User | `/var/www/html/user.txt` | `HTB{php_u4f_1s_n0t_d3ad}` |
| Root | `/root/root.txt` | `HTB{1ns4n3_ch41n_m4st3r_php_pwn}` |

---

## 🛠️ Tools Required

| Tool | Purpose | Install |
|------|---------|---------|
| `nmap` | Port scanning | `apt install nmap` |
| `ffuf` | Directory brute-force | `apt install ffuf` |
| `Gopherus` | FastCGI gopher payload | `git clone` from GitHub |
| `Python3` | Exploit scripting | Pre-installed |
| `Ghidra` | Binary reverse engineering | `apt install ghidra` |
| `Chisel` | Network pivoting | GitHub releases |
| `GDB + pwndbg` | Buffer overflow analysis | `apt install gdb` |
| `netcat` | Reverse shell listener | `apt install netcat-traditional` |

---

## 🐳 Setup — Build the Machine

### Requirements
- Docker
- Docker Compose
- Linux (Kali recommended)

### Step 1 — Clone the Repo
```bash
git clone https://github.com/MohammedRifad123/Killing-2.0.git
cd Killing-2.0
```

### Step 2 — Build and Start
```bash
cd docker/
docker compose up --build -d
```

> ⏳ First build takes 5-10 minutes.

### Step 3 — Verify Running
```bash
docker compose ps
```

Expected:
```
NAME              STATUS
killing2_web      Up   ✅
killing2_admin    Up   ✅
killing2_db       Up   ✅
```

### Step 4 — Get Target IP
```bash
docker inspect killing2_web | grep '"IPAddress"'
```

---

## 📁 File Structure

```
Killing-2.0/
│
├── README.md                  ← You are here
│
├── docker/                    ← Machine build files
│   ├── Dockerfile
│   ├── docker-compose.yml
│   ├── startup.sh
│   ├── config/
│   │   ├── php.ini            ← Intentional UAF misconfiguration
│   │   ├── www.conf           ← PHP-FPM Unix socket config
│   │   └── nginx.conf         ← Web server config
│   ├── www/
│   │   ├── index.php          ← AES key hidden in JS source
│   │   ├── preview.php        ← SSRF vulnerable endpoint
│   │   ├── upload.php         ← UAF trigger endpoint
│   │   └── robots.txt         ← Hints for players
│   └── binaries/
│       └── php-helper.c       ← Vulnerable SUID binary source
│
├── exploit/                   ← Attack scripts
│   ├── 01_encrypt_url.py      ← AES URL encryptor for SSRF bypass
│   ├── 02_rce.py              ← PHP UAF + FastCGI RCE exploit
│   └── 03_docker_escape.sh    ← Docker socket escape script
│
└── writeup/                   ← Full walkthrough
    └── WRITEUP.md
```

---

## 💡 Hints for Players

- Enumerate **everything** — not all open ports are useful
- Read the **page source** carefully
- `phpinfo.php` is a goldmine — always check it
- **Not all paths lead to root** — some are rabbit holes
- Every step chains to the next — nothing works alone
- `uname -r` and `find / -perm -4000` are your best friends

---

## 🔍 Vulnerabilities Used

| CVE / Type | Description |
|------------|-------------|
| SSRF | Server-Side Request Forgery via gopher:// scheme |
| PHP UAF | Use-After-Free in upload progress handler (PHP 8.1.11) |
| Insecure Config | session.upload_progress.cleanup = Off |
| Stack BOF | Buffer overflow in custom SUID binary (no canary) |
| Docker Escape | Exposed docker.sock inside container |

---

## ⚠️ Disclaimer

```
This machine is built for EDUCATIONAL PURPOSES ONLY.
Run ONLY in an isolated lab/VM network.
Never deploy on a public network or production server.
The author is not responsible for any misuse.
```

---

## 👤 Author

**Mohammed Rifad**

> BSc Multimedia and Web Technology (AI & Robotics) Student
> Cybersecurity Enthusiast | CTF Machine Builder

- 🐙 GitHub: [MohammedRifad123](https://github.com/MohammedRifad123)
- 🔴 Killing: 1 → [killing-dark-access](https://github.com/MohammedRifad123/killing-dark-access)
- 🔴 Killing: 2 → [Killing-2.0](https://github.com/MohammedRifad123/Killing-2.0)

---

## ⭐ If You Like This Machine

- Give it a ⭐ Star on GitHub
- Share with the CTF community
- Try [Killing: 1](https://github.com/MohammedRifad123/killing-dark-access) first if you haven't!

---

*Made with ❤️ by Mohammed Rifad*
