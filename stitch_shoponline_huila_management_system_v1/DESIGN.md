---
name: Huila Management Hub
colors:
  surface: '#f7f9fb'
  surface-dim: '#d8dadc'
  surface-bright: '#f7f9fb'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f2f4f6'
  surface-container: '#eceef0'
  surface-container-high: '#e6e8ea'
  surface-container-highest: '#e0e3e5'
  on-surface: '#191c1e'
  on-surface-variant: '#3f4944'
  inverse-surface: '#2d3133'
  inverse-on-surface: '#eff1f3'
  outline: '#6f7973'
  outline-variant: '#bec9c2'
  surface-tint: '#1b6b51'
  primary: '#004532'
  on-primary: '#ffffff'
  primary-container: '#065f46'
  on-primary-container: '#8bd6b7'
  inverse-primary: '#8bd6b6'
  secondary: '#565e74'
  on-secondary: '#ffffff'
  secondary-container: '#dae2fd'
  on-secondary-container: '#5c647a'
  tertiary: '#004065'
  on-tertiary: '#ffffff'
  tertiary-container: '#005888'
  on-tertiary-container: '#97cdff'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#a6f2d1'
  primary-fixed-dim: '#8bd6b6'
  on-primary-fixed: '#002116'
  on-primary-fixed-variant: '#00513b'
  secondary-fixed: '#dae2fd'
  secondary-fixed-dim: '#bec6e0'
  on-secondary-fixed: '#131b2e'
  on-secondary-fixed-variant: '#3f465c'
  tertiary-fixed: '#cde5ff'
  tertiary-fixed-dim: '#94ccff'
  on-tertiary-fixed: '#001d32'
  on-tertiary-fixed-variant: '#004b74'
  background: '#f7f9fb'
  on-background: '#191c1e'
  surface-variant: '#e0e3e5'
typography:
  display-lg:
    fontFamily: Inter
    fontSize: 48px
    fontWeight: '700'
    lineHeight: 56px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Inter
    fontSize: 32px
    fontWeight: '600'
    lineHeight: 40px
    letterSpacing: -0.01em
  headline-lg-mobile:
    fontFamily: Inter
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
  headline-md:
    fontFamily: Inter
    fontSize: 24px
    fontWeight: '600'
    lineHeight: 32px
  headline-sm:
    fontFamily: Inter
    fontSize: 20px
    fontWeight: '600'
    lineHeight: 28px
  body-lg:
    fontFamily: Inter
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Inter
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  body-sm:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
  label-md:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '500'
    lineHeight: 20px
  label-sm:
    fontFamily: Inter
    fontSize: 12px
    fontWeight: '600'
    lineHeight: 16px
    letterSpacing: 0.05em
  table-data:
    fontFamily: Inter
    fontSize: 14px
    fontWeight: '400'
    lineHeight: 20px
rounded:
  sm: 0.125rem
  DEFAULT: 0.25rem
  md: 0.375rem
  lg: 0.5rem
  xl: 0.75rem
  full: 9999px
spacing:
  base: 4px
  xs: 4px
  sm: 8px
  md: 16px
  lg: 24px
  xl: 32px
  2xl: 48px
  gutter: 24px
  margin-mobile: 16px
  margin-desktop: 32px
---

## Brand & Style

The design system is engineered for **ShopOnline Huila**, a platform dedicated to the efficient management of e-commerce operations. The brand personality is rooted in reliability and regional pride, balancing the organic heritage of Huila’s agricultural excellence with the precision of modern software.

The visual style is **Corporate Modern with a Minimalist execution**. It prioritizes high data density and functional clarity to reduce cognitive load for users managing complex inventories and orders. By utilizing generous white space and a structured card-based architecture, the design system ensures that the interface feels organized and professional, never overwhelming. The emotional response is one of "quiet confidence"—a tool that works as hard as the businesses it supports.

## Colors

The palette is anchored by **Deep Emerald Green**, a nod to the coffee-growing landscapes of Huila, serving as the primary action color. This is balanced by **Corporate Navy**, used for navigation elements and high-level typography to establish authority and stability.

The background utilizes a **Light Gray (#F8FAFC)** to minimize eye strain during long working sessions, while white is reserved for interactive cards and surfaces. This subtle tonal difference creates a clear distinction between the "canvas" and the "workstations" (the UI components). Functional colors for success, warning, and error states are calibrated for high legibility against light backgrounds.

## Typography

This design system utilizes **Inter** exclusively to leverage its exceptional legibility in data-heavy environments. The typeface is chosen for its tall x-height and neutral character, which ensures that complex tables and dashboards remain readable even at smaller sizes.

- **Headlines:** Use a bold weight with slight negative letter-spacing for a compact, authoritative look.
- **Body Text:** Standardized at 16px for primary reading and 14px for secondary information and data tables.
- **Labels:** Small labels use an uppercase treatment with increased tracking to differentiate them from actionable text.
- **Data-Heavy Views:** In management tables, use `table-data` to maintain vertical rhythm while maximizing the number of visible rows.

## Layout & Spacing

The layout follows a **fluid grid system** with fixed sidebar navigation. This allows the dashboard to adapt to various screen widths while maintaining a consistent control center on the left.

- **Grid:** A 12-column grid is used for desktop layouts.
- **Rhythm:** An 8px base unit (starting from 4px) governs all spatial relationships. Elements should be spaced in multiples of 8 (8, 16, 24, 32, etc.) to ensure a clean, mathematical harmony.
- **Margins:** A generous 32px outer margin on desktop keeps content from feeling cramped against the browser edges.
- **Mobile Reflow:** On mobile, columns collapse to a single stack, margins reduce to 16px, and the sidebar transforms into a bottom navigation bar or a hidden drawer.

## Elevation & Depth

The design system employs **Tonal Layering** combined with soft, functional shadows to create hierarchy. Depth is used sparingly to signify importance rather than for decoration.

- **Level 0 (Background):** Light Gray (#F8FAFC), completely flat.
- **Level 1 (Cards/Containers):** Pure white background with a 1px border (#E2E8F0) and no shadow. Used for secondary content blocks.
- **Level 2 (Active Dashboard Widgets):** Pure white with a subtle ambient shadow (0px 4px 6px rgba(15, 23, 42, 0.05)). This elevates the primary working area.
- **Level 3 (Overlays/Modals):** High-contrast shadows (0px 10px 15px rgba(15, 23, 42, 0.1)) to focus user attention on critical management tasks.

Avoid high-contrast borders; instead, use subtle shifts in surface color to define boundaries.

## Shapes

The shape language is **Soft (0.25rem)**. This subtle rounding of corners communicates modernism and approachability without losing the professional, "engineered" feel required for a business tool.

- **Small Components (Buttons, Inputs, Badges):** 0.25rem (4px) corner radius.
- **Medium Components (Cards, Modals):** 0.5rem (8px) corner radius.
- **Large Components (Main Content Areas):** 0.75rem (12px) corner radius.

This progression ensures that smaller elements inside larger containers feel nested and visually coherent.

## Components

### Buttons
- **Primary:** Filled Emerald Green with white text. High-contrast, used for the main "Success" path (e.g., "Add Product").
- **Secondary:** Outlined in Navy or Slate. Used for secondary actions (e.g., "Export Data").
- **Ghost:** Text-only in Navy. Used for tertiary actions within lists.

### Input Fields
Inputs use a white background, 1px light gray border, and a 4px corner radius. The focus state is signaled by a 2px Emerald Green border. Labels are always positioned above the field for maximum clarity.

### Cards
Cards are the primary container for the e-commerce dashboard. They feature a white background and a subtle bottom border to separate the header from the body content.

### Tables
Management tables are the core of this system. They use a zebra-stripe pattern (every other row #F8FAFC) to help users track data across wide screens. Hover states on rows use a very faint green tint.

### Chips & Badges
Used for order status (e.g., "Pending", "Shipped"). These utilize a "soft-fill" approach: a very light background color matching the text color (e.g., Light Green background with Deep Emerald text).

### Sidebar Navigation
A persistent vertical bar in Corporate Navy. Icons are minimalist and paired with 12px labels. The active state is indicated by an Emerald Green vertical indicator on the far left of the item.