<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?php echo $pageTitle ?? 'ShopOnline Huila'; ?></title>
    <link rel="icon" type="image/png" href="/ShopOnline_Huila/assets/favicon.png">
    <link rel="shortcut icon" href="/ShopOnline_Huila/assets/favicon.png">
    <link rel="apple-touch-icon" href="/ShopOnline_Huila/assets/logo.png">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "on-tertiary-fixed-variant": "#004b74",
                        "inverse-on-surface": "#eff1f3",
                        "background": "#f7f9fb",
                        "on-background": "#191c1e",
                        "error": "#ba1a1a",
                        "on-primary-fixed": "#002116",
                        "on-primary-container": "#8bd6b7",
                        "surface-container-low": "#f2f4f6",
                        "surface-variant": "#e0e3e5",
                        "surface-container-lowest": "#ffffff",
                        "on-error": "#ffffff",
                        "on-surface-variant": "#3f4944",
                        "on-secondary": "#ffffff",
                        "surface-container-highest": "#e0e3e5",
                        "on-secondary-fixed-variant": "#3f465c",
                        "on-primary-fixed-variant": "#00513b",
                        "on-tertiary": "#ffffff",
                        "surface-dim": "#d8dadc",
                        "surface-container-high": "#e6e8ea",
                        "surface": "#f7f9fb",
                        "primary-fixed-dim": "#8bd6b6",
                        "on-tertiary-container": "#97cdff",
                        "outline-variant": "#bec9c2",
                        "surface-container": "#eceef0",
                        "secondary": "#565e74",
                        "on-primary": "#ffffff",
                        "primary-container": "#065f46",
                        "tertiary-fixed": "#cde5ff",
                        "on-tertiary-fixed": "#001d32",
                        "on-secondary-container": "#5c647a",
                        "secondary-container": "#dae2fd",
                        "on-secondary-fixed": "#131b2e",
                        "tertiary-fixed-dim": "#94ccff",
                        "surface-tint": "#1b6b51",
                        "primary-fixed": "#a6f2d1",
                        "on-surface": "#191c1e",
                        "primary": "#004532",
                        "surface-bright": "#f7f9fb",
                        "secondary-fixed": "#dae2fd",
                        "on-error-container": "#93000a",
                        "tertiary-container": "#005888",
                        "inverse-surface": "#2d3133",
                        "tertiary": "#004065",
                        "secondary-fixed-dim": "#bec6e0",
                        "inverse-primary": "#8bd6b6",
                        "outline": "#6f7973",
                        "error-container": "#ffdad6"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "margin-mobile": "16px",
                        "2xl": "48px",
                        "sm": "8px",
                        "lg": "24px",
                        "gutter": "24px",
                        "md": "16px",
                        "margin-desktop": "32px",
                        "base": "4px",
                        "xs": "4px",
                        "xl": "32px"
                    },
                    "fontFamily": {
                        "headline-sm": ["Inter"],
                        "body-sm": ["Inter"],
                        "table-data": ["Inter"],
                        "label-sm": ["Inter"],
                        "label-md": ["Inter"],
                        "headline-md": ["Inter"],
                        "headline-lg": ["Inter"],
                        "body-md": ["Inter"],
                        "display-lg": ["Inter"],
                        "headline-lg-mobile": ["Inter"],
                        "body-lg": ["Inter"]
                    },
                    "fontSize": {
                        "headline-sm": ["20px", { "lineHeight": "28px", "fontWeight": "600" }],
                        "body-sm": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                        "table-data": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                        "label-sm": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }],
                        "label-md": ["14px", { "lineHeight": "20px", "fontWeight": "500" }],
                        "headline-md": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "headline-lg": ["32px", { "lineHeight": "40px", "letterSpacing": "-0.01em", "fontWeight": "600" }],
                        "body-md": ["16px", { "lineHeight": "24px", "fontWeight": "400" }],
                        "display-lg": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "700" }],
                        "headline-lg-mobile": ["24px", { "lineHeight": "32px", "fontWeight": "600" }],
                        "body-lg": ["18px", { "lineHeight": "28px", "fontWeight": "400" }]
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
    <?php if (!empty($extraStyles)): ?>
    <style><?php echo $extraStyles; ?></style>
    <?php endif; ?>
</head>
<body class="bg-background text-on-background antialiased flex h-screen overflow-hidden">
