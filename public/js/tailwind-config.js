tailwind.config = {
  darkMode: "class",
  theme: {
    extend: {
      colors: {
        // Primary - Emerald Green
        primary: "#10B981",
        "primary-dark": "#059669",
        "primary-light": "#34D399",
        "on-primary": "#ffffff",
        
        // Secondary - Soft Mint
        secondary: "#ECFDF5",
        "secondary-dark": "#D1FAE5",
        "on-secondary": "#374151",
        
        // Action - Gold/Amber
        action: "#F59E0B",
        "action-dark": "#D97706",
        "action-light": "#FBBF24",
        "on-action": "#ffffff",
        
        // Text - Charcoal
        text: "#374151",
        "text-light": "#6B7280",
        "text-dark": "#1F2937",
        
        // Background & Surface
        background: "#ECFDF5",
        surface: "#ffffff",
        "surface-variant": "#F3F4F6",
        
        // Borders & Outlines
        outline: "#D1D5DB",
        "outline-variant": "#E5E7EB",
        
        // Status colors
        error: "#EF4444",
        "error-container": "#FEE2E2",
        "on-error": "#ffffff",
        success: "#10B981",
        warning: "#F59E0B",
        info: "#3B82F6"
      },
      borderRadius: {
        DEFAULT: "0.5rem",
        lg: "0.75rem",
        xl: "1rem",
        "2xl": "1.5rem",
        full: "9999px"
      },
      spacing: {
        "container-padding": "32px",
        "section-margin": "48px",
        gutter: "24px",
        unit: "8px",
        "card-gap": "24px"
      },
      fontSize: {
        "h1": ["40px", { lineHeight: "1.2", letterSpacing: "-0.02em", fontWeight: "700" }],
        "h2": ["32px", { lineHeight: "1.3", letterSpacing: "-0.01em", fontWeight: "700" }],
        "h3": ["24px", { lineHeight: "1.4", fontWeight: "600" }],
        "h1-mobile": ["28px", { lineHeight: "1.2", fontWeight: "700" }],
        "h2-mobile": ["24px", { lineHeight: "1.3", fontWeight: "700" }],
        "body-lg": ["18px", { lineHeight: "1.6", fontWeight: "400" }],
        "body-md": ["16px", { lineHeight: "1.6", fontWeight: "400" }],
        "body-sm": ["14px", { lineHeight: "1.5", fontWeight: "400" }],
        "label-caps": ["12px", { lineHeight: "1.2", letterSpacing: "0.05em", fontWeight: "700" }]
      }
    }
  }
};
