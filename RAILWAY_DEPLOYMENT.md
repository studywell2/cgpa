# Deploying GCPA Calculator to Railway

Railway offers a free tier that doesn't require a credit card, making it perfect for deploying your Laravel application without payment.

## Prerequisites
- Railway account (free, no credit card required) - Sign up at https://railway.app
- GitHub repository with your code

## Steps to Deploy

### 1. Connect Your GitHub Repository
1. Go to https://railway.app and sign in
2. Click "New Project"
3. Select "Deploy from GitHub repo"
4. Connect your GitHub account and select your GCPA repository
5. Click "Deploy now"

### 2. Add a Database
1. In your Railway project dashboard, click "Add Plugin"
2. Select "Database" (choose PostgreSQL or MySQL - both have free tiers)
3. The database will be automatically configured and connected

### 3. Set Environment Variables
In your Railway project settings, add these environment variables:

```
APP_NAME=GCPA
APP_ENV=production
APP_KEY=base64:oMhlArqke4jChUVtjIJDQpKPXlGz9wEYcDy5voZt7h0=
APP_DEBUG=false
APP_URL=https://your-app-name.up.railway.app
DB_CONNECTION=mysql
```

Note: Railway automatically provides `DATABASE_URL` for your database, which Laravel will use automatically.

### 4. Deploy
Railway will automatically deploy your application when you push to your main branch. The `railway.toml` file in your project is already configured for Railway deployment.

### 5. Run Database Migrations
After deployment, run migrations:
1. Go to your Railway project
2. Click on your app service
3. Go to the "Variables" tab and add a temporary variable: `RUN_MIGRATIONS=true`
4. This will trigger the pre-deploy command in `railway.toml` to run migrations
5. Remove the `RUN_MIGRATIONS` variable after successful migration

## Notes
- Railway's free tier includes 512MB RAM, 1GB disk, and automatic scaling
- Your app will get a URL like `https://your-app-name.up.railway.app`
- No credit card required for the free tier
- If you need more resources, you can upgrade later

## Troubleshooting
- If deployment fails, check the build logs in Railway dashboard
- Make sure your `composer.json` and `package.json` are properly configured
- Ensure all environment variables are set correctly