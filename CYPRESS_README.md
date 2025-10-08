Quick Cypress E2E tests

Assumptions:
- The Laravel app is running and reachable at the URL in your `.env` `APP_URL` or at `http://localhost`.
- The DB is seeded and the app allows creating resources via the web UI at the expected routes.
- Authentication: tests assume public access to create pages or that you will adapt them to log in first.
 - Authentication: tests now perform login using seeded admin user `admin@agencia.com` / `password123`.

Install deps and open Cypress:

```bash
npm install
npm run cypress:open
```

Run headless:

```bash
npm run cypress:run
```

If your app runs on a different port, set APP_URL before running:

```bash
APP_URL=http://localhost:8000 npm run cypress:open
```

Notes:
- Tests use simple selectors like `input[name="nombre"]`. Ensure form inputs use those name attributes or adapt tests.
- For protected routes, add a login flow to `beforeEach` in the spec files.
 - The tests already include a simple login flow that fills `input[name="email"]` and `input[name="password"]`. Ensure your login view uses these names or update the specs.
