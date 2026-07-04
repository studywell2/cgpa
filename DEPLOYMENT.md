# GCPA Calculator - Deployment Guide

## Quick Start Deployment to Render

### Prerequisites
- GitHub account with repository
- Render account (free tier available)

### Step-by-Step Deployment

#### 1. Prepare Your Repository
```bash
# If not already initialized
git init
git add .
git commit -m "Ready for Render deployment"
git remote add origin YOUR_GITHUB_REPO_URL
git push -u origin main
```

#### 2. Deploy to Render

**Option A: Automatic (Recommended)**
1. Create account at https://render.com
2. Click "New+" → "Web Service"
3. Connect your GitHub account
4. Select your GCPA repository
5. Render will automatically read `render.yaml` configuration
6. Click "Create Web Service"

**Option B: Manual Configuration**
1. Go to Render Dashboard
2. Click "New+" → "Web Service"
3. Connect GitHub repository
4. Configure:
   - **Name:** gcpa-calculator
   - **Region:** Oregon (closest to you)
   - **Branch:** main
   - **Runtime:** PHP
   - **Build Command:** `composer install --no-dev && npm run build`
   - **Start Command:** `php artisan serve --host=0.0.0.0 --port=$PORT`
5. Add Environment Variables:
   ```
   APP_NAME=GCPA Calculator
   APP_ENV=production
   APP_DEBUG=false
   APP_KEY=(auto-generated)
   ```
6. Click "Create Web Service"

#### 3. Monitor Deployment
- Watch the build logs in Render dashboard
- Deployment typically takes 2-3 minutes
- Once complete, you'll get a URL like: `https://gcpa-calculator.onrender.com`

### Verify Deployment
1. Visit your Render URL
2. Test CGPA calculation
3. Navigate to `/about` and `/help`
4. Check responsive design on mobile

### Important Notes
- **Free Tier:** 750 hours/month, sleeps after 15 min inactivity
- **Wake Time:** ~30 seconds after sleeping
- **Auto Deploy:** Pushes to GitHub trigger automatic rebuilds
- **SSL:** Automatically provided by Render
- **Database:** Uses SQLite (no external database needed)

### Troubleshooting
**Build Fails:**
- Check build logs in Render dashboard
- Verify PHP version compatibility (requires 8.2+)
- Ensure all Composer dependencies are installable

**Runtime Errors:**
- Check environment variables
- Verify file permissions
- Review Laravel logs in Render dashboard

**Slow Performance:**
- First request after wake-up takes longer
- Consider upgrading to paid tier for better performance
- Optimize Vite build process

### Advanced Configuration
**Custom Domain:**
1. Purchase domain from registrar
2. Add domain in Render dashboard
3. Update DNS records as instructed by Render
4. SSL certificate automatically configured

**Environment-Specific Settings:**
- Update `APP_URL` environment variable
- Add production-specific API keys if needed
- Configure caching and optimization settings

## Additional Deployment Options

### Heroku
See `HEROKU_DEPLOYMENT.md` for detailed instructions.

### Railway
See `RAILWAY_DEPLOYMENT.md` for detailed instructions.

## Support
- Render Documentation: https://render.com/docs
- Laravel Deployment: https://laravel.com/docs/deployment
- Contact support through Render dashboard