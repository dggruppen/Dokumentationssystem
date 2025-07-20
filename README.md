# 🗂️ Dokumentationssystem för IT-miljöer – DG Gruppen

Detta system är utvecklat i Laravel och syftar till att digitalt dokumentera kunders IT-miljöer, servrar, system, konton, nätverk, licenser m.m.  
Byggt av DG Gruppen för att hantera dokumentation, åtkomstkontroller och ändringsförslag på ett säkert och effektivt sätt.

---

## 🛠 Funktioner

- ✅ Inloggning med roller: **Administratör**, **Tekniker**, **View Only**
- ✅ Dokumentationsstruktur per kund
- ✅ Behörighetsstyrning per bolag
- ✅ 🔔 Notifieringar via **mail** och **dashboard**
- ✅ 📨 Stöd för ändringsförslag som skickas till tekniker/admin
- ✅ 💌 SMTP-konfig via Loopia
- ✅ 🧩 Queue support (köhantering för e-post)
- ✅ 🛎️ Navbar med notifieringsikon och mark-as-read
- ✅ ⚙️ Färdig systemd-tjänst för queue-worker

---

## 🛠️ Installation

<details>
  <summary>Klicka här för fullständig installationsguide (Ubuntu VPS)</summary>


```
# 🚀 Installationsanvisningar – Laravel Dokumentationssystem (Ubuntu VPS)

Detta dokument beskriver hur du installerar och driftsätter dokumentationssystemet på en ny VPS med Ubuntu 22.04 eller senare.

---

## 🧱 1. Förberedelser

### Uppdatera systemet
```bash
sudo apt update && sudo apt upgrade -y
```

### Installera nödvändiga paket
```bash
sudo apt install -y nginx php php-mysql php-mbstring php-xml php-bcmath php-curl php-zip php-cli php-common php-tokenizer unzip curl git mariadb-server
```

---

## 🐘 2. Installera Composer

```bash
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
composer --version
```

---

## 🗃️ 3. Klona projektet

```bash
cd /var/www
sudo git clone https://github.com/dggruppen/Dokumentationssystem.git
cd Dokumentationssystem
sudo chown -R www-data:www-data .
```

---

## ⚙️ 4. Konfigurera Laravel

```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate
```

---

## 🌐 5. Nginx-konfiguration

Skapa fil:
```bash
sudo nano /etc/nginx/sites-available/dokumentation
```

Innehåll:
```nginx
server {
    listen 80;
    server_name example.com;

    root /var/www/Dokumentationssystem/public;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include snippets/fastcgi-php.conf;
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

```bash
sudo ln -s /etc/nginx/sites-available/dokumentation /etc/nginx/sites-enabled/
sudo nginx -t && sudo systemctl reload nginx
```

---

## 🔐 6. Databasinställningar

Logga in:
```bash
sudo mariadb
```

Skapa användare och databas:
```sql
CREATE DATABASE dokumentation;
CREATE USER 'dokadmin'@'localhost' IDENTIFIED BY 'ValfrittLösenord';
GRANT ALL PRIVILEGES ON dokumentation.* TO 'dokadmin'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

Uppdatera `.env`:
```env
DB_DATABASE=dokumentation
DB_USERNAME=dokadmin
DB_PASSWORD=ValfrittLösenord
```

---

## 📬 7. Mailinställning

SMTP-lösenord bör läggas som miljövariabel:
```bash
export SMTP_PASSWORD="hemligtlösen"
```

---

## 🔁 8. Queue & background-tjänst

```bash
php artisan queue:table
php artisan migrate
```

Systemd-tjänst:
```ini
[Unit]
Description=Laravel Queue Worker
After=network.target

[Service]
User=www-data
Group=www-data
Restart=always
ExecStart=/usr/bin/php /var/www/Dokumentationssystem/artisan queue:work --sleep=3 --tries=3

[Install]
WantedBy=multi-user.target
```

Spara som:
```bash
sudo nano /etc/systemd/system/laravel-queue-worker.service
sudo systemctl daemon-reexec
sudo systemctl enable laravel-queue-worker
sudo systemctl start laravel-queue-worker
```

---

## ✅ Klart!

Du kan nu logga in och börja använda systemet på:

```
http://[din-server-ip]/
```

Skapa admin-användare via seed eller registrering om det är öppet.

---

## 🛡️ Tips för produktion

- Använd SSL (Let's Encrypt + certbot)
- `APP_ENV=production` och `APP_DEBUG=false` i `.env`
- Sätt upp daglig backup av databasen
- Övervaka `queue:work` med systemd-loggar: `journalctl -u laravel-queue-worker`

---

📧 Support: [info@dggruppen.se](mailto:info@dggruppen.se)
🌐 https://dggruppen.se
```

</details>


### 1. Klona projektet
```bash
git clone https://github.com/dggruppen/Dokumentationssystem.git
cd Dokumentationssystem/
```

### 2. Installera beroenden
```bash
composer install
npm install && npm run build
```

### 3. Kopiera miljöfil och generera nyckel
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Migrera databasen
```bash
php artisan migrate
```

---

## 📬 SMTP-inställningar

```env
MAIL_MAILER=smtp
MAIL_HOST=mailcluster.loopia.se
MAIL_PORT=587
MAIL_USERNAME=dokument@scantomail.se
MAIL_PASSWORD=${SMTP_PASSWORD}
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=dokument@scantomail.se
MAIL_FROM_NAME="Dokumentationssystem"
```

🔐 **Viktigt:** Ange SMTP-lösenordet som en miljövariabel istället för att spara det i `.env`-filen.

### Exempel på hur du sätter miljövariabeln:

**Linux/macOS (ex. `.bashrc`, `.zshrc`):**
```bash
export SMTP_PASSWORD="DittSäkraLösenord2025!"
```

**Ubuntu server globalt:**
```bash
sudo nano /etc/environment
SMTP_PASSWORD="DittSäkraLösenord2025!"
```

**GitHub Actions eller CI/CD:**
Lägg till `SMTP_PASSWORD` som en "Repository Secret".


## ⚙️ Köhantering (queue)

### Skapa tabeller för kö:
```bash
php artisan queue:table
php artisan migrate
```

### Starta kö lokalt:
```bash
php artisan queue:work
```

### Systemd-tjänst:
```bash
sudo cp /var/www/dokumentation/laravel-queue-worker.service /etc/systemd/system/
sudo systemctl daemon-reexec
sudo systemctl enable laravel-queue-worker
sudo systemctl start laravel-queue-worker
```

---

## 📌 Notifieringssystem

- Dashboard visar notifieringar via `unreadNotifications`
- Ikon i navbar med 🔴 räknare
- Markera som läst med knapp

---

## 📄 Exempel på notifieringar

- Nytt ändringsförslag
- Förslag godkänt
- Återställning av lösenord
- Kommentar eller dokumentuppdatering

---

## 🧱 Mappstruktur (kort)

```
app/
├── Http/Controllers/
├── Models/
├── Notifications/
resources/views/
├── dashboard.blade.php
├── layouts/app.blade.php
routes/web.php
public/index.php
artisan
.env.example
composer.json
```

---

## 👥 Roller & Behörigheter

- **Admin** – full åtkomst, skapande, granskning
- **Tekniker** – teknisk dokumentation och hantering
- **View Only** – kan läsa + skicka ändringsförslag

---

## 📞 Support

By DG Gruppen  
📧 info@dggruppen.se  
🌐 https://dggruppen.se  
