# Quick Debug Commands for Railway

## 🔍 Essential Railway CLI Commands

If you need to debug the deployment, install Railway CLI:

```bash
# Install Railway CLI (macOS)
brew install railway

# Login to Railway
railway login

# Link to your project
railway link

# View live logs
railway logs

# Open Railway dashboard
railway open
```

---

## 🐛 Common Error Scenarios

### Scenario 1: "Database file not found"

**Check in Railway logs**:
```
SQLSTATE[HY000]: Unable to open database file
```

**What the Procfile does**:
```bash
touch database/database.sqlite  # Creates the file
```

**If this fails**, the directory might not exist. The solution is already in place, but if you see this error, the issue might be permissions.

---

### Scenario 2: "Class not found"

**Check in Railway logs**:
```
Class 'App\...' not found
Class 'Database\Seeders\ProductionSeeder' not found
```

**Solution**: Railway should run `composer install` automatically. Check if:
1. `composer.json` is present ✅
2. `composer.lock` is present ✅
3. Build phase completed successfully

**Verify in nixpacks.toml**:
```toml
[phases.setup]
nixPkgs = ["php82", "php82Packages.composer"]
```

---

### Scenario 3: "500 Error on Dashboard"

**Check in Railway logs**:
```
[timestamp] production.ERROR: ... {Stack trace}
```

**Things to verify**:
1. Database file exists: `/app/database/database.sqlite`
2. Migrations ran successfully
3. Seeder completed
4. No missing environment variables

**Key logs to look for**:
```
[INFO] Running migrations...
[INFO] Migrated: ...
[INFO] Seeding database...
[INFO] ✅ Usuario admin creado
```

---

### Scenario 4: "Port already in use"

**Check in Railway logs**:
```
Address already in use
```

**Solution**: This shouldn't happen on Railway, but if it does:
- Railway automatically assigns an available port
- The app uses `${PORT:-8080}` to listen on Railway's port
- No action needed from your side

---

## 📊 What Success Looks Like in Logs

When everything works correctly, you should see:

```
[timestamp] INFO  Running migrations...
[timestamp] INFO  Migrated: 2024_01_create_users_table
[timestamp] INFO  Migrated: 2024_01_create_entities_table
[timestamp] INFO  Migrated: 2024_01_create_sectoristas_table
... (all migrations)

[timestamp] INFO  Seeding database...
═══════════════════════════════════════════════════════
🌱 SIMPAC - Seeder de Producción
═══════════════════════════════════════════════════════

✅ Usuario admin creado
   Email: admin@simpac.com
   Password: admin123
   ⚠️  CAMBIAR LA CONTRASEÑA DESPUÉS DEL PRIMER LOGIN

═══════════════════════════════════════════════════════
✅ Seeder de producción completado!
═══════════════════════════════════════════════════════

[timestamp] INFO  Starting Laravel development server: http://0.0.0.0:8080
```

---

## 🔐 Check Specific Files on Railway

If you have Railway CLI installed, you can check files:

```bash
# SSH into Railway container (if available)
railway run bash

# Check if database exists
ls -la database/database.sqlite

# Check permissions
stat database/database.sqlite

# Check environment variables
railway variables
```

---

## 📝 Manual Migration & Seeding (Emergency)

If automated seeding fails, you can run manually:

```bash
# Via Railway CLI
railway run php artisan migrate --force
railway run php artisan db:seed --force --class=ProductionSeeder

# Or update the Procfile temporarily to just run migrations
web: touch database/database.sqlite && php artisan migrate --force && php artisan serve --host=0.0.0.0 --port=${PORT:-8080}
```

---

## 🎯 Key Files to Check

| File | Purpose | Status |
|------|---------|--------|
| `Procfile` | Start command | ✅ Updated |
| `nixpacks.toml` | Build configuration | ✅ Present |
| `railway.json` | Railway settings | ✅ Present |
| `database/seeders/ProductionSeeder.php` | Production seeder | ✅ Created |
| `.env.example` | Environment template | ✅ Present |

---

## 🚨 Emergency Rollback

If the new deployment breaks everything:

1. Go to Railway dashboard
2. Click on "Deployments"
3. Find the previous working deployment
4. Click "Redeploy"

Or via CLI:
```bash
railway rollback
```

---

## 💡 Pro Tips

1. **Always check Railway logs first** - Most issues are visible there
2. **Environment variables without quotes** - Already fixed ✅
3. **Database path must be absolute** - Already set to `/app/database/database.sqlite` ✅
4. **Use ProductionSeeder for production** - Already configured ✅
5. **Keep APP_DEBUG=false in production** - Already set ✅

---

## 📞 When to Ask for Help

Share these details:

1. **Railway logs** (last 50-100 lines)
2. **Specific error message** (copy the full stack trace)
3. **Which step failed**: Build, Deploy, or Runtime
4. **What you were trying to do**: Login, access dashboard, etc.

---

**Quick Links**:
- 📚 [Railway Docs](https://docs.railway.app)
- 🐘 [Laravel Deployment Docs](https://laravel.com/docs/deployment)
- 🗄️ [SQLite in Production](https://laravel.com/docs/database#sqlite-configuration)
