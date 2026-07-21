---
name: BookBuilder Studio
description: Refined dark-mode literary studio and reading progress tracker
colors:
  primary: "#f59e0b"
  primary-light: "#fbbf24"
  primary-deep: "#d97706"
  accent-emerald: "#10b981"
  accent-rose: "#f43f5e"
  accent-indigo: "#6366f1"
  neutral-bg: "#0b0f19"
  neutral-dark: "#111827"
  neutral-card: "#1e293b"
  text-pearl: "#f8fafc"
  text-slate: "#cbd5e1"
  text-muted: "#94a3b8"
  border-glass: "#ffffff14"
  border-gold: "#f59e0b4d"
typography:
  display:
    fontFamily: "Cormorant Garamond, Georgia, serif"
    fontSize: "clamp(2rem, 4vw, 3.25rem)"
    fontWeight: 700
    lineHeight: "1.1"
    letterSpacing: "-0.02em"
  headline:
    fontFamily: "Cormorant Garamond, Georgia, serif"
    fontSize: "1.5rem"
    fontWeight: 700
    lineHeight: "1.2"
  body:
    fontFamily: "Plus Jakarta Sans, system-ui, sans-serif"
    fontSize: "0.875rem"
    fontWeight: 400
    lineHeight: "1.6"
  label:
    fontFamily: "Plus Jakarta Sans, system-ui, sans-serif"
    fontSize: "0.75rem"
    fontWeight: 600
    letterSpacing: "0.03em"
rounded:
  sm: "12px"
  md: "16px"
  full: "9999px"
spacing:
  sm: "8px"
  md: "16px"
  lg: "24px"
  xl: "32px"
components:
  button-primary:
    backgroundColor: "{colors.primary}"
    textColor: "{colors.neutral-bg}"
    rounded: "{rounded.sm}"
    padding: "10px 20px"
  button-primary-hover:
    backgroundColor: "{colors.primary-light}"
  button-ghost:
    backgroundColor: "{colors.border-glass}"
    textColor: "{colors.text-slate}"
    rounded: "{rounded.sm}"
    padding: "10px 18px"
  card-glass:
    backgroundColor: "{colors.neutral-card}"
    textColor: "{colors.text-pearl}"
    rounded: "{rounded.md}"
    padding: "24px"
---

# Design System: BookBuilder Studio

## 1. Overview

**Creative North Star: "The Obsidian Library Sanctuary"**

BookBuilder Studio is a dark, quiet digital workspace engineered specifically for literary exploration and progress tracking. It pairs deep obsidian background tones (#0b0f19) with warm amber and gold highlights (#f59e0b), creating the focused ambiance of a private evening library. Translucent glass card surfaces with subtle backdrop blurs provide physical depth without visual clutter.

The system explicitly rejects generic corporate SaaS aesthetics, harsh light themes, dense spreadsheets, and unnecessary decorative gradients. The surface exists to showcase books, reading completion metrics, and chapter progress in an elegant, distraction-free environment.

**Key Characteristics:**
- Deep obsidian backdrop with translucent slate glass containers
- Warm amber/gold accents used exclusively for key CTA actions and progress indicators
- Expressive serif headlines (Cormorant Garamond) paired with crisp sans-serif UI text (Plus Jakarta Sans)
- High contrast body copy (Pearl white #f8fafc and Slate #cbd5e1) for effortless readability
- Smooth, micro-animated state feedback with exponential easing

## 2. Colors

The color system relies on a restrained palette anchored by deep obsidian background surfaces and warm gold accents.

### Primary
- **Amber Gold** (#f59e0b): Primary brand accent used for main call-to-action buttons, active progress rings, and key badges.
- **Amber Warm Light** (#fbbf24): Hover state highlight for gold buttons and interactive badges.
- **Amber Deep** (#d97706): Gradient endpoint and active state anchor.

### Accents
- **Emerald Active** (#10b981): Denotes active reading status, completion states, and success indicators.
- **Rose Highlight** (#f43f5e): Warning and removal states.
- **Indigo Soft** (#6366f1): Secondary category tags.

### Neutral
- **Obsidian Dark** (#0b0f19): Root background surface.
- **Slate Container** (rgba(30, 41, 59, 0.65)): Glass card background color.
- **Pearl White** (#f8fafc): High-contrast primary text and main titles.
- **Slate Text** (#cbd5e1): Secondary labels and metadata text.
- **Muted Text** (#94a3b8): Placeholder text and subtle captions (hitting ≥4.5:1 contrast against card background).

### Named Rules
**The Gold Rarity Rule.** Primary gold accents are reserved for key CTAs, active progress metrics, and selected states. Never flood screen sections with solid gold backgrounds.

## 3. Typography

**Display Font:** Cormorant Garamond, Georgia, serif
**Body Font:** Plus Jakarta Sans, system-ui, sans-serif
**Label/Mono Font:** Plus Jakarta Sans, system-ui, sans-serif

**Character:** Classic literary elegance meets modern digital clarity. The pairing balances traditional book typography with precise UI readability.

### Hierarchy
- **Display** (Bold 700, clamp(2rem, 4vw, 3.25rem), line-height 1.1): Hero titles and main page headers.
- **Headline** (Bold 700, 1.5rem / 24px, line-height 1.2): Book titles and modal headers.
- **Title** (Semi-bold 600, 1.125rem / 18px, line-height 1.3): Section headers and card titles.
- **Body** (Regular 400, 0.875rem / 14px, line-height 1.6, max line length 65ch): Reading notes, descriptions, and metadata.
- **Label** (Semi-bold 600, 0.75rem / 12px, letter-spacing 0.03em): Badges, progress tags, and button labels.

### Named Rules
**The Balanced Headline Rule.** Display and section headings use `text-wrap: balance` to prevent awkward line breaks and single-word orphans.

## 4. Elevation

Depth is conveyed primarily through translucent layering and subtle glassmorphic blurs rather than heavy drop shadows.

### Shadow Vocabulary
- **Gold Glow Hover** (`0 12px 30px -10px rgba(245, 158, 11, 0.18)`): Used on interactive glass cards on hover.
- **Button Shadow** (`0 4px 14px rgba(245, 158, 11, 0.3)`): Rest shadow for primary gold buttons.

### Named Rules
**The Flat Glass Rule.** Cards and containers sit flat at rest with a 1px `rgba(255,255,255,0.08)` border. Elevation lift and subtle gold glow appear only on hover or active selection.

## 5. Components

### Buttons
- **Shape:** Rounded 12px radius (`--rounded-sm`)
- **Primary (Gold):** Background `linear-gradient(135deg, #f59e0b, #d97706)`, text `#0b0f19` font-weight 700. Hover adds slight lift (`translateY(-1px)`) and amber-light tint.
- **Ghost:** Background `rgba(255, 255, 255, 0.05)`, text `#cbd5e1`, 1px glass border. Hover shifts background to `rgba(255, 255, 255, 0.1)` and text to Pearl White.

### Cards / Containers
- **Corner Style:** 16px radius (`--rounded-md`)
- **Background:** Slate glass `rgba(30, 41, 59, 0.65)` with `backdrop-filter: blur(12px)`
- **Border:** 1px solid `rgba(255, 255, 255, 0.08)`
- **Padding:** 24px (1.5rem)

### Inputs / Fields
- **Style:** Background `rgba(15, 23, 42, 0.6)`, 12px radius, 1px glass border. Text `#f8fafc`, placeholder `#94a3b8`.
- **Focus:** Border shifts to Gold (`#f59e0b`) with a subtle `rgba(245, 158, 11, 0.15)` focus ring.

### Navigation
- **Style:** Sticky top navigation bar with `backdrop-filter: blur(16px)` and bottom glass border (`rgba(255, 255, 255, 0.08)`). Height ~64px with max-width 80rem centered container.

## 6. Do's and Don'ts

### Do:
- **Do** maintain deep obsidian (#0b0f19) as the primary background tone.
- **Do** ensure body text reaches at least 4.5:1 contrast against background surfaces.
- **Do** use `Cormorant Garamond` for book titles and high-level section headings.
- **Do** apply smooth cubic-bezier transitions (`cubic-bezier(0.16, 1, 0.3, 1)`) for interactive card and button state changes.

### Don't:
- **Don't** use generic corporate SaaS layouts, dense spreadsheet grids, or harsh 1px solid gray borders.
- **Don't** apply decorative gradient text (`background-clip: text`) or 2D grid background lines.
- **Don't** pair 1px borders with heavy drop shadows (>16px blur) on the same container element.
- **Don't** over-round cards with 32px+ border radii. Keep cards at 12–16px.
