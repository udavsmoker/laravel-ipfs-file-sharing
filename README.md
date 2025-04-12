# Sharey - IPFS File Transfer Platform

Sharey is a decentralized file transfer platform built on the InterPlanetary File System (IPFS) to securely and efficiently share files across a distributed network. It aims to provide a user-friendly and secure alternative for file sharing by leveraging the power of IPFS for decentralized storage and fast retrieval.

## Features

- **Decentralized File Sharing**: Files are stored across a distributed network, ensuring redundancy and availability without relying on a central server.
- **Secure File Transfers**: Utilizes encryption to ensure files are securely transferred between users, protecting them from unauthorized access.
- **Easy Upload and Download**: Upload and download large files with ease, making it suitable for a variety of use cases, from personal to business-related file transfers.
- **Minimal Latency**: The system leverages IPFS's high-speed content retrieval, allowing users to access shared files faster than traditional file-sharing methods.

## Installation

Follow these steps to set up and run the **Sharey** IPFS file-sharing project locally.

---

### 1. Download XAMPP (PHP 8.2.12)

Download XAMPP: [https://www.apachefriends.org/download.html](https://www.apachefriends.org/download.html)

During installation, ensure the following components are selected:

- Apache
- MySQL
- PHP

After installation, start **Apache** and **MySQL** from the XAMPP control panel.

---

### 2. Clone the Project

Click the **Explorer** button in XAMPP to open the `htdocs` directory, then run:

```bash
git clone https://github.com/udavsmoker/laravel-ipfs-file-sharing.git
```

---

### 3. Install Composer

Download and install Composer: [https://getcomposer.org/download/](https://getcomposer.org/download/)

---

### 4. Install Node.js

Download and install Node.js: [https://nodejs.org/en/download](https://nodejs.org/en/download)

---

### 5. Install Kubo (IPFS)

Download Kubo v0.34.1: [https://github.com/ipfs/kubo/releases/tag/v0.34.1](https://github.com/ipfs/kubo/releases/tag/v0.34.1)

---

### 6. Install Dependencies

Open the project folder (e.g., with VS Code) and run:

```bash
composer install
npm install
```

---

### 7. Setup Environment File

Copy the `.env.example` file to `.env`:

**For CMD:**

```bash
copy .env.example .env
```

**For PowerShell:**

```powershell
Copy-Item .env.example .env
```

---

### 8. Configure Mail (SMTP)

We recommend using Yahoo Mail SMTP: [https://help.yahoo.com/kb/SLN4075.html](https://help.yahoo.com/kb/SLN4075.html)

1. Create a Yahoo account.
2. Generate an app password: [https://help.yahoo.com/kb/generate-password-sln15241.html](https://help.yahoo.com/kb/generate-password-sln15241.html)

Update your `.env` with:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mail.yahoo.com
MAIL_PORT=465
MAIL_USERNAME=yourMail@yahoo.com
MAIL_PASSWORD=yourAppPassword
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=yourMail@yahoo.com
MAIL_FROM_NAME="${APP_NAME}"
```

---

### 9. Generate Application Key

```bash
php artisan key:generate
```

This will set the `APP_KEY` in your `.env` file.

---

### 10. Migrate the Database

```bash
php artisan migrate
```

---

### 11. Initialize IPFS

```bash
ipfs init
```

---

### 12. Run the Application

Use three terminals to run the app:

**Terminal 1 – Start IPFS Daemon:**

```bash
ipfs daemon
```

**Terminal 2 – Start Laravel Server:**

```bash
php artisan serve
```

**Terminal 3 – Start Vite:**

```bash
npm run dev
```

---

### Notes

- Ensure you are using PHP 8.2 (not higher).

---

## Usage

- Upload files by selecting them from your device and clicking the "Upload" button.
- To download files, enter the unique file hash (CID) and click "Download".
- Share file hashes with others to allow them to download files directly from the IPFS network.

## Security

Sharey ensures the security of your files by encrypting them during transmission. Files are only accessible by users who have the proper access credentials, ensuring that unauthorized access is prevented.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgements

- IPFS (InterPlanetary File System) for decentralized file storage.
- The community contributors for continuous improvements and feedback.


(A Project for Software Engineering course. BHOS. 2025)
