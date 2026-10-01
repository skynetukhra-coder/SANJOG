# SANJOG - Principal Accountant General Portal

Institutional web portal and administrative management system for the Principal Accountant General (A&E), West Bengal.

## Overview
SANJOG provides public grievance handling, subscriber and employee services, pension and GPF records management, circulars, tenders, and administrative workflows.

## Architecture & Technology Stack
- **Framework:** CodeIgniter 3.1.13 (with PHP 8.2+ compatibility layer)
- **Modern Engine:** CodeIgniter 4.5.5 (deployed in `ci4/`)
- **Language / Runtime:** PHP 8.2+
- **Database:** MySQL 8.0+ / MariaDB (Charset: `utf8mb4`, Collation: `utf8mb4_unicode_ci`)
- **Backend Components:**
  - Spreadsheet processing via PhpSpreadsheet bridge
  - PDF generation via mPDF
  - Email notification system via PHPMailer
- **Frontend Stack:** Bootstrap, jQuery, Font Awesome

## Directory Structure
- `application/` - CodeIgniter 3 application controllers, models, views, and libraries
- `system/` - Upgraded CodeIgniter 3.1.13 core engine
- `ci4/` - CodeIgniter 4.5.5 framework architecture
- `assets/` - Static stylesheets, scripts, fonts, and images
- `files/` - Document uploads and storage
- `editor/` - Rich-text editing components

## Requirements
- PHP >= 8.1 with `intl`, `mysqli`, `mbstring`, `curl`, `gd`, `openssl` extensions enabled
- MySQL 8.0+ or MariaDB 10.4+
- Apache 2.4+ with `mod_rewrite` enabled

## License
Proprietary / Government institutional portal.
