# 📚 Dokumentationssystem för IT-miljöer

Detta är ett komplett digitalt dokumentationssystem utvecklat i **Laravel**. Det är framtaget av **DG Gruppen** för att strukturera, lagra och hantera information om våra kunders IT-miljöer – på ett säkert, flexibelt och framtidssäkert sätt.

---

## ✨ Funktioner

- ✅ **Inloggning med 2FA** (tvåfaktorsautentisering)
- ✅ **Rollbaserat behörighetssystem**
  - Administratör
  - Tekniker
  - View-only med förslagsrätt
- ✅ **Koppling av användare till företag**
- ✅ **Företagsspecifik dokumentation**
- ✅ **Förslagsflöde:** View-only-användare kan lämna förslag för granskning
- ✅ **Modulhantering för olika typer av data**
  - Infrastruktur
  - Servrar & nätverk
  - Användare
  - Mjukvara
  - Backup & säkerhet
- ✅ **Notifieringar för ändringar och granskning**
- ✅ **Toggla funktioner via adminvy**
- ✅ **Versionering och ändringshistorik**
- ✅ **Loggning, revisionsspårning och säkerhetspolicyer**

---

## 🧱 Teknisk uppsättning

- Laravel 10+
- PHP 8.2+
- MariaDB
- Composer, NPM, Vite
- Ubuntu 22.04 LTS (rekommenderad driftmiljö)
- Valfri VPS eller molntjänst (t.ex. DigitalOcean + Laravel Forge)

---

## 🚀 Installation (på server)

```bash
# Klona projektet
git clone https://github.com/dggruppen/Dokumentationssystem.git
cd Dokumentationssystem/laravel-version

# Installera beroenden
composer install
npm install && npm run build

# Konfigurera .env
cp .env.example .env
php artisan key:generate

# Sätt rätt databasuppgifter i .env
php artisan migrate --seed

# Rättigheter
chown -R www-data:www-data .
chmod -R 775 storage bootstrap/cache

# Aktivera queue och scheduler (exempel)
php artisan queue:work &
```

---

## 🖥️ Exempel på systemarkitektur

```
┌────────────────────────┐
│   Laravel + MariaDB    │
│   + Tailwind / Vite    │
└────────────┬───────────┘
             │
   ┌─────────▼─────────┐
   │  Dokumenttyper    │
   │  Modulhantering   │
   └─────────┬─────────┘
             │
   ┌─────────▼─────────┐
   │  Användare & Roller│
   └─────────┬─────────┘
             │
     Granskningsflöde
```

---

## 📂 Projektstruktur (kort)

```
laravel-version/
├── app/
│   ├── Models/
│   └── Http/Controllers/
├── resources/views/
├── routes/web.php
├── public/
├── .env.example
└── README.md
```

---

## 🔐 Säkerhet och dataskydd

Systemet följer DG Gruppens interna informationssäkerhetspolicys. All data är krypterad i transit (SSL), och känslig information lagras enligt branschstandard.

---

## 🛠 Vidareutveckling

Under planering:

- ✅ API-stöd för externa integrationer
- ✅ Mobilanpassad PWA
- ✅ Dokumentationsgenerator (PDF/export)
- ✅ Loggcentral för felsökning
- ✅ Docker & CI/CD-stöd (valfritt)

---

## 🤝 Bidra / Feedback

Detta är ett internt system men vi tar gärna emot **idéer, buggrapporter och förbättringsförslag** via GitHub Issues eller direkt till:

📧 toni.kazarian@dggruppen.se  
🌐 [dggruppen.se](https://dggruppen.se)

---

## 📄 Licens

© DG Gruppen – internt dokumentationssystem. Ej för publikt bruk utan tillstånd.
