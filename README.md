# Jan Louis Rabara — Portfolio

A responsive, dark portfolio built with Next.js App Router, React, TypeScript, and CSS.

## Run locally

```sh
npm install
npm run dev
```

Open http://localhost:3000. For a production build, run `npm run build`, then `npm start`.

## Add project content

Edit `src/data/portfolio.ts`. The four university projects from the résumé are already listed. Each project has these fields ready to fill:

- `githubUrl`: the public repository URL, or an empty string to hide the link.
- `liveUrl`: the deployed application URL, or an empty string to hide the link.
- `image`: a screenshot path, such as `/projects/dalg.png`. Put the file in `public/projects/`.
- `imageAlt`: a short description of the screenshot.

The illustrated placeholders remain visible until screenshots are provided. They are decorative title cards, not application screenshots. Local source folders should be reviewed separately; avoid copying entire project folders, dependencies, or secrets into `public/`.

The `profile` object contains the contact email, public GitHub/LinkedIn profile links, immediate availability, and work preferences. Empty social links are hidden. Longer biography and experience text live in `src/app/page.tsx`; styling lives in `src/app/globals.css`.

## Content notes

Education uses the confirmed graduation date of September 11, 2026. Project and internship descriptions reflect follow-up clarification: AI-assisted coursework and capstone prototypes, an unfinished Android checkout, and an internship analytics exercise using sample data that was reviewed but not merged. FEU Merch Shop uses Java/XML, verified from its source. Awards come from the supplied résumé. The original outdated PDF is not published. Contact uses the résumé email; the phone number and references are not displayed.

The font stylesheet uses Google Fonts with local system font fallbacks. Contact opens the visitor’s email client and does not store or submit form data. No project repository or deployment URL has been invented.

## Project screenshots and walkthroughs

Dominant Asia and JLED Coffee have four real application screenshots each and a silent, captioned WebM walkthrough in `public/projects/`. Expand **Screenshots & recorded walkthrough** on either project card to play the video or view full-size screenshots. Video files load on demand.

These were captured from isolated local copies with newly seeded fictional records, not company production data. The capstone recording covers dashboards, products, inventory, and orders; it does not verify checkout, forecasting, or allocation execution. JLED covers its admin dashboard and menu, booking, and account lists. Original application folders are preserved. No live demo deployment is required to display these files.

Edit the `demo` fields in `src/data/portfolio.ts` to change the gallery labels and walkthrough descriptions. Keep matching `.webm` and `.vtt` filenames for each project ID.

## Validation commands

```sh
npm run typecheck
npm run build
```

Deployment supports any host compatible with a standard Next.js application. Build command: `npm run build`. Start command: `npm start`.
