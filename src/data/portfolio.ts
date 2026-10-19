export type Project = {
  id: string;
  title: string;
  category: "Web & mobile" | "Web application" | "Prototype" | "Mobile application";
  role: string;
  description: string;
  tags: string[];
  githubUrl: string;
  liveUrl: string;
  image: string;
  imageAlt: string;
  featured?: boolean;
  demo?: {
    screenshots: { file: string; caption: string }[];
    summary: string;
  };
};

// Add public links and screenshot paths here when they are ready.
// For screenshots, put a file in public/projects and use /projects/filename.png.
export const projects: Project[] = [
  {
    id: "dalg", title: "Dominant Asia", category: "Web & mobile",
    role: "Web development · AI-assisted capstone",
    description: "An award-winning capstone prototype based on company requirements I documented. Built most of the web application with AI assistance; a teammate handled the mobile API endpoints. Includes forecasting and allocation balancing stock utilization, urgency, waiting time, and geographic grouping. Demonstrated at defense, with payment-return and allocation issues still unresolved. Academic requirements included a payment gateway the company did not want; the prototype was not handed over for operational use.",
    tags: ["React / Inertia", "Laravel", "MySQL", "Python", "Google OR-Tools"],
    githubUrl: "https://github.com/202210215FEU/WebApp", liveUrl: "", image: "/projects/dalg-dashboard.png", imageAlt: "Dominant Asia admin dashboard with fictional sample records", featured: true,
    demo: {
      screenshots: [
        { file: "dalg-dashboard", caption: "Admin dashboard" },
        { file: "dalg-products", caption: "Product catalog" },
        { file: "dalg-inventory", caption: "Inventory management" },
        { file: "dalg-orders", caption: "Order management" },
      ],
      summary: "Browse dashboard totals, poultry products, inventory, and sample order statuses. This recording does not demonstrate payment checkout, forecasting, or allocation execution.",
    },
  },
  {
    id: "jled", title: "JLED Coffee", category: "Web application",
    role: "Developer · AI-assisted coursework",
    description: "Built a coffee shop coursework application with AI assistance using CodeIgniter’s MVC structure. The code includes account login, menu management, bookings, and customer profiles. Created for class demonstration.",
    tags: ["CodeIgniter", "PHP", "UI design"],
    githubUrl: "", liveUrl: "", image: "/projects/jled-dashboard.png", imageAlt: "JLED Coffee admin dashboard",
    demo: {
      screenshots: [
        { file: "jled-dashboard", caption: "Admin dashboard" },
        { file: "jled-menu", caption: "Coffee menu" },
        { file: "jled-bookings", caption: "Booking records" },
        { file: "jled-accounts", caption: "Account management" },
      ],
      summary: "Explore the admin dashboard, then switch between coffee menu items, booking records, and user accounts using the database selector.",
    },
  },
  {
    id: "workin", title: "Workin’ Progress", category: "Prototype",
    role: "Project leader · Technopreneurship competition",
    description: "A business mockup entered in a technopreneurship competition, proposing contractor screening, job bidding, messaging, and scheduling. Presented as a service-platform concept rather than an implemented application.",
    tags: ["Product concept", "Prototyping", "UX design"],
    githubUrl: "", liveUrl: "", image: "", imageAlt: "Workin’ Progress service platform prototype",
  },
  {
    id: "feu", title: "FEU Merch Shop", category: "Mobile application",
    role: "Template adaptation · AI-assisted coursework",
    description: "Adapted an Android shopping template for FEU merchandise with AI assistance. Customized branding, product displays, cart behavior, and Firebase data handling. Created for coursework; checkout remained incomplete.",
    tags: ["Java", "XML", "Android", "Firebase"],
    githubUrl: "", liveUrl: "", image: "", imageAlt: "FEU Merch Shop mobile application",
  },
];

export const profile = {
  name: "Jan Louis O. Rabara",
  email: "louisrabara@gmail.com",
  location: "Quezon City, Philippines",
  githubUrl: "https://github.com/jLRabaraa",
  linkedinUrl: "https://www.linkedin.com/in/louis-rabara-jlr/",
  availability: "Available to start immediately",
  workPreferences: "Open to remote, hybrid, and onsite junior full-stack roles across Metro Manila, including Makati and Taguig.",
};

export const skillGroups = [
  { title: "Frontend & mobile", items: ["JavaScript", "React", "Expo", "HTML & CSS", "Java", "XML"] },
  { title: "Backend & data", items: ["PHP", "Laravel", "CodeIgniter", "Python", "MySQL", "PostgreSQL"] },
  { title: "Tools & platforms", items: ["Git & GitHub", "API integration", "Amazon EC2", "Google Cloud", "Windows Server"] },
  { title: "Design & systems", items: ["UI/UX design", "System design", "Photoshop", "SAP S/4HANA"] },
];
