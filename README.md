## Clone Project

Clone and run 

```
composer install
```

```
php artisan storage:link
```

```
php artisan migrate
```

## 🌐 Make Your Laravel App Public with Cloudflare Tunnel

Your Laravel app runs locally at `http://localhost:8000`, and we will expose it using a Cloudflare Tunnel without exposing the MySQL (XAMPP) database.

---

### ✅ Step 1: Create the tunnel

```bash
cloudflared tunnel create springmountain
```
### ✅ Step 2: Create the config file

Create a file at this location:

```bash
C:\Users\Admin\.cloudflared\config.yml
```

Paste the following content into it:

```bash
tunnel: springmountain
credentials-file: C:\Users\Admin\.cloudflared\YOUR-TUNNEL-ID.json

ingress:
  - hostname: springmountain.site
    service: http://localhost:8000
  - service: http_status:404
```

⚠️ Important: Replace YOUR-TUNNEL-ID.json with the actual file name created in Step 1. It will look like xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx.json.

### ✅ Step 3: Route domain to tunnel

```bash
cloudflared tunnel route dns springmountain springmountain.site
```

This command links the domain springmountain.site to your tunnel.

### ✅ Step 4: Start the tunnel

```bash
cloudflared tunnel run springmountain
```

This will expose your local Laravel site to the public at https://springmountain.site.

### ✅ Step 5: Done!

Visit your site:
👉 https://springmountain.site

### 🔁 How to Start Tunnel Again

▶️ Without PM2

```bash
cloudflared tunnel run springmountain
```

❗ Keep the terminal open. The tunnel will stop if the terminal closes or your PC shuts down.

### ✅ With PM2 (Recommended)

Start tunnel in the background:

```bash
pm2 start "cloudflared tunnel run springmountain" --name springmountain-tunnel
```

Control commands:

```bash
pm2 stop springmountain-tunnel
pm2 restart springmountain-tunnel
pm2 status
```

Auto-start on system boot:

```bash
pm2 save
pm2 startup
```

This setup ensures your Laravel site is always accessible via the internet while keeping your database private and secure.
