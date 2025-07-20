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

## 🚀 Installation

### 1. Klona projektet
```bash
git clone https://github.com/dggruppen/Dokumentationssystem.git
cd Dokumentationssystem/laravel-version
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
MAIL_PASSWORD=BroSto2018!
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=dokument@scantomail.se
MAIL_FROM_NAME="Dokumentationssystem"
```

---

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
