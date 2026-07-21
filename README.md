# BookBuilder Studio

> A refined, distraction-free digital studio and reading progress manager for avid book lovers and catalog collectors.

![BookBuilder Studio Banner](PRODUCT.md)

---

## 📚 Overview

**BookBuilder Studio** is an elegant, modern web application built with **Angular 19** and **Tailwind CSS v4**. It provides readers with a distraction-free digital workspace to manage personal book collections, track reading completion metrics, update page progress in real time, and organize titles by genre.

Designed around a dark obsidian editorial aesthetic (`#0b0f19`) with warm amber gold accents (`#f59e0b`), BookBuilder Studio combines high-contrast readability with keyboard-first navigation and responsive design.

---

## ✨ Features

- **📊 2026 Reading Progress Dashboard**: Real-time stats calculation including average completion percentage, total pages read, currently reading count, and total titles.
- **📖 Active Book Quickjump**: One-click quickjump card to jump straight into your current active reading session.
- **🎨 Uncropped Cover Art Showcase**: Framed book cover displays with soft ambient backdrop blurs that preserve 100% of cover typography and artwork without aggressive cropping.
- **🏷️ Semantic Genre Badging**: Color-coded genre pills for instant visual wayfinding:
  - 🌹 **Thriller / Mystery**: Crimson Rose
  - 🌿 **Psychology / Self-Help**: Emerald
  - ⚡ **Design / Tech**: Indigo
  - 🌌 **Sci-Fi / Fantasy**: Cyan
  - ☀️ **General / Other**: Amber Gold
- **⚡ Interactive Reader & Progress Studio**: Adjust reading progress via percentage slider, exact page counters, or quick-add (+10%, +25%, Mark 100% Complete) controls.
- **🔍 Fast Search & Filter Suite**:
  - Instant live search by book title or author.
  - Quick tab filters: `All`, `Reading`, `Completed`, `Favorites`.
  - Multi-attribute sorting: by `Progress`, `Title`, or `Pages`.
- **⌨️ Keyboard Shortcuts & Accessibility**:
  - Press `/` anywhere to immediately focus the search bar.
  - Press `Esc` to close modals.
  - Full WCAG AA contrast compliance and `:focus-visible` keyboard focus indicators.
  - `@media (prefers-reduced-motion: reduce)` support.

---

## 🛠️ Technology Stack

- **Framework**: [Angular 19](https://angular.dev/)
- **Styling**: [Tailwind CSS v4](https://tailwindcss.com/) & SCSS Design Tokens
- **UI Components**: [Angular Material 19](https://material.angular.io/)
- **Language**: TypeScript 5.6
- **Typography**: *Cormorant Garamond* (Serif display) & *Plus Jakarta Sans* (Sans body)

---

## 🚀 Getting Started

### Prerequisites

Ensure you have **Node.js** (v18 or higher) and `npm` installed.

```bash
node -v
npm -v
```

### Installation

1. **Clone the repository**:
   ```bash
   git clone https://github.com/tarkikRomanski/bookBuilder.git
   cd bookBuilder
   ```

2. **Install dependencies**:
   ```bash
   npm install
   ```

3. **Start the local development server**:
   ```bash
   npm start
   ```

4. Open your browser and navigate to `http://localhost:4200/`.

---

## 📜 Available Scripts

In the project directory, you can run:

| Command | Action |
|---|---|
| `npm start` | Launches dev server at `http://localhost:4200/` with live reload. |
| `npm run build` | Compiles production bundle into the `dist/book-checker` directory. |
| `npm test` | Runs unit tests via Karma & Jasmine runner in single-run mode. |

---

## 📂 Project Structure

```
bookBuilder/
├── .impeccable/           # Impeccable design system config & critique reports
├── src/
│   ├── app/
│   │   ├── app.component.html       # Application shell & header navigation
│   │   ├── book-list/               # Catalog grid, banner, filters & modals
│   │   ├── book-item/               # Uncropped cover card & progress item
│   │   ├── book-show/               # Interactive reader & detail view
│   │   ├── models/                  # BookModel data contracts
│   │   └── services/                # LocalStorage & catalog state service
│   ├── styles.scss                  # Design system tokens, glassmorphism & accessibility
│   └── index.html                   # HTML entry point & Google Fonts imports
├── DESIGN.md                        # Official 6-section visual design specification
├── PRODUCT.md                       # Product strategy, target personas & principles
├── package.json                     # Node dependencies and npm scripts
└── README.md                        # Project documentation
```

---

## 📄 License

This project is open-source under the MIT License.
