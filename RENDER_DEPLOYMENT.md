# Deploying GCPA Calculator to Render

Render is a modern cloud platform that supports PHP/Laravel applications with a free tier available.

## Prerequisites
- Render account (free tier available) - Sign up at https://render.com
- GitHub repository with your code

## Steps to Deploy

### 1. Connect Your GitHub Repository
1. Go to https://render.com and sign in
2. Click "New" → "Web Service"
3. Connect your GitHub account and select your GCPA repository
4. Choose the branch you want to deploy from (usually `main`)

### 2. Configure Build & Deploy Settings
Use these settings in the Render dashboard:

**Build Command:**
```bash
npm run build
```

**Start Command:**
```bash
php artisan serve --host=0.0.0.0 --port=$PORT
```

### 3. Add a Database
1. In your Render dashboard, click "New" → "PostgreSQL" or "MySQL"
2. Choose the free tier
3. Note the database credentials provided by Render

### 4. Set Environment Variables
In your web service settings, add these environment variables:

```
APP_NAME=GCPA
APP_ENV=production
APP_KEY=base64:oMhlArqke4jChUVtjIJDQpKPXlGz9wEYcDy5voZt7h0=
APP_DEBUG=false
DB_CONNECTION=mysql
DB_HOST=your-render-database-host
DB_PORT=5432 (for PostgreSQL) or 3306 (for MySQL)
DB_DATABASE=your-database-name
DB_USERNAME=your-database-username
DB_PASSWORD=your-database-password
```

Note: Render provides database connection details in the database dashboard.

### 5. Deploy
1. Click "Create Web Service"
2. Render will build and deploy your application automatically
3. Your app will get a URL like `https://your-app-name.onrender.com`

### 6. Run Database Migrations
After deployment, run migrations using Render's shell:
1. Go to your web service dashboard
2. Click "Shell" tab
3. Run: `php artisan migrate --force`

## Notes
- Render's free tier includes 750 hours of runtime per month
- Your app will sleep after 15 minutes of inactivity on the free tier
- Render supports both PostgreSQL and MySQL databases
- Automatic deployments when you push to your connected branch

## Troubleshooting
- Check the build logs in Render dashboard if deployment fails
- Ensure all environment variables are set correctly
- Make sure your database credentials are accurate
- Verify that `composer.json` and `package.json` are properly configured

## Alternative: Using render.yaml (Optional)
You can also create a `render.yaml` file in your repository root for more advanced configuration:

```yaml
services:
  - type: web
    name: gcpa-app
    runtime: php
    buildCommand: npm run build
    startCommand: php artisan serve --host=0.0.0.0 --port=$PORT
    envVars:
      - key: APP_ENV
        value: production
      - key: APP_KEY
        value: base64:oMhlArqke4jChUVtjIJDQpKPXlGz9wEYcDy5voZt7h0=
      - key: APP_DEBUG
        value: false
      - key: DB_CONNECTION
        value: mysql

  - type: pserv
    name: gcpa-db
    runtime: mysql
    envVars:
      - key: MYSQL_DATABASE
        value: gcpa_db
      - key: MYSQL_USER
        value: gcpa_user
```

This approach allows Render to automatically create both your app and database when you connect the repository.