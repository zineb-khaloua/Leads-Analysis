
**Lead Analysis & Scoring System**

This project is a Lead Analysis & Scoring System built with Laravel, PHP, and optionally integrated with AI APIs. It simulates a real-world workflow for collecting, analyzing, and categorizing business leads based on their websites. The project demonstrates the use of web scraping, data seeding, AI classification, and interactive data presentation.


**Features**

**Website Content Analysis**

- Scrapes each website’s HTML content using Symfony DomCrawler.

- Stores the extracted text in the database (website_analysis field).

- AI-Powered Lead Scoring (Optional)

- Classifies leads into High, Medium, or Low categories.

- Assigns a numerical score (0–100%) representing lead quality or conversion potential.

- Can be integrated with Hugging Face or other AI APIs for real-time text analysis.

**Data Presentation**

- Uses Blade templates and Bootstrap 5 to display lead data in an elegant table.

- Integrates DataTables for:

- Pagination

- Searching

- Sorting

**Technologies Used**

- Backend: PHP, Laravel 10

- Frontend: Blade Templates, Bootstrap 5

- Database: MySQL / MariaDB

- HTTP & Scraping: Symfony DomCrawler, Symfony HttpClient

- DataTables: Interactive tables for leads

- AI (Optional): Hugging Face API for lead classification

**License**

- This project is open-source and free to use under the MIT License



**Project Workflow**

- Generate Sample Websites (You can point the seeder or lead importer to real public websites  instead of the local demo pages.)

- HTML files representing various companies are placed in public/sample-sites.

- Database Seeding

- Leads are seeded with Faker-generated job titles and industries.

- Each lead points to a sample website.

- Website content is scraped and stored in the database.

- Lead Scoring (AI Integration)

- Website content is analyzed with an AI model.

- Each lead is assigned a score and a category based on content sentiment or relevance.

- Display Leads

- Leads are displayed in a responsive, paginated, searchable DataTable.

- Categories are highlighted using colored badges for quick visual recognition.

**how to use**

**Clone**:

- git clone https://github.com/zineb-khaloua/Leads-Analysis.git


- Create a new database :Lead Scoring

- Navigate to database/leads.sql.

- Import this file into the your database.  

**Configure .env (example):**

APP_NAME="Lead Scoring"
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=lead_scoring_db
DB_USERNAME=root
DB_PASSWORD=

**Hugging Face**
HUGGINGFACE_API_TOKEN=hf_xxx...


**Run migrations + seed:**

php artisan migrate:fresh --seed


**Serve and open:**

php artisan serve
# visit http://127.0.0.1:8000
