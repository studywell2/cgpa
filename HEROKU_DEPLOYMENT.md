# Deploying GCPA Calculator to Heroku

## Prerequisites
- Heroku account (free tier available)
- Heroku CLI installed
- Git repository

## Steps to Deploy

### 1. Create Heroku App
```bash
heroku create your-app-name
```

### 2. Add ClearDB MySQL Addon
```bash
heroku addons:create cleardb:ignite
```

### 3. Set Environment Variables
```bash
heroku config:set APP_ENV=production
heroku config:set APP_DEBUG=false
heroku config:set APP_KEY=base64:oMhlArqke4jChUVtjIJDQpKPXlGz9wEYcDy5voZt7h0=
```

### 4. Deploy Code
```bash
git add .
git commit -m "Prepare for Heroku deployment"
git push heroku main
```

### 5. Run Migrations
```bash
heroku run php artisan migrate --force
```

### 6. Update APP_URL
After deployment, get your app URL:
```bash
heroku apps:info
```
Then update the APP_URL in Heroku config:
```bash
heroku config:set APP_URL=https://your-app-name.herokuapp.com
```

## Notes
- The app is configured to automatically parse ClearDB database credentials
- Free Heroku dynos sleep after 30 minutes of inactivity
- ClearDB free plan has 5MB limit