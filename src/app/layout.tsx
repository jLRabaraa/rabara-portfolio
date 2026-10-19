import type { Metadata } from "next";
import "./globals.css";

export const metadata: Metadata = {
  title: "Jan Louis Rabara | Junior Full-Stack Developer",
  description: "Jan Louis O. Rabara — FEU Diliman IT graduate seeking junior full-stack developer roles. Based in Quezon City, available immediately for remote, hybrid, and onsite opportunities.",
};

export default function RootLayout({ children }: Readonly<{ children: React.ReactNode }>) {
  return <html lang="en"><body>{children}</body></html>;
}
