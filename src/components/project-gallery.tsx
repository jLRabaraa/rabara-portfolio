"use client";

import { useState } from "react";
import { projects, type Project } from "@/data/portfolio";

const filters = ["All projects", "Web", "Mobile", "Prototype"] as const;

function ProjectDemo({ project }: { project: Project }) {
  const [open, setOpen] = useState(false);
  if (!project.demo) return null;
  return <details className="project-demo" onToggle={event => setOpen(event.currentTarget.open)}>
    <summary>Screenshots & recorded walkthrough</summary>
    {open && <div className="demo-content">
      <p className="demo-note">Recorded locally with fictional sample data. Academic prototype.</p>
      <video controls playsInline preload="none" poster={project.image} width="1440" height="900" aria-label={`${project.title} recorded walkthrough`}>
        <source src={`/projects/${project.id}-walkthrough.webm`} type="video/webm" />
        <track default kind="captions" src={`/projects/${project.id}-walkthrough.vtt`} srcLang="en" label="English scene descriptions" />
        Your browser does not support this video. Use the download link below.
      </video>
      <p>Silent walkthrough with captions. {project.demo.summary}</p>
      <a className="demo-download" href={`/projects/${project.id}-walkthrough.webm`} download>Download walkthrough</a>
      <div className="demo-screenshots">{project.demo.screenshots.map(shot => <a key={shot.file} href={`/projects/${shot.file}.png`} target="_blank" rel="noopener noreferrer" aria-label={`${shot.caption} — open full-size screenshot in a new tab`}>
        <figure><img src={`/projects/${shot.file}.png`} alt={`${project.title}: ${shot.caption}, using sample data`} loading="lazy" width="1440" height="900" /><figcaption>{shot.caption} ↗</figcaption></figure>
      </a>)}</div>
    </div>}
  </details>;
}

function ProjectArt({ project }: { project: Project }) {
  if (project.image) return <div className="project-art"><img src={project.image} alt={project.imageAlt} loading="lazy" /></div>;
  return <div className={`project-art art-${project.id}`} aria-label={`${project.title}: screenshot coming soon`}>
    <div className="art-grid" />
    <div className="project-symbol" aria-hidden="true">
      {project.id === "dalg" ? <><span className="bar"/><span className="bar"/><span className="bar"/><span className="bar"/></> : project.id === "jled" ? <span className="coffee-cup">☕</span> : project.id === "workin" ? <span className="workin-symbol">w<span>↗</span></span> : <span className="feu-symbol">FEU<span>MERCH SHOP</span></span>}
    </div>
    <span className="art-caption">{project.id === "dalg" ? "SYSTEMS THAT CONNECT." : project.id === "jled" ? "A BETTER DAILY BREW." : project.id === "workin" ? "GOOD WORK STARTS HERE." : "CAMPUS. IN YOUR POCKET."}</span>
    <span className="preview-label">Screenshot coming soon</span>
  </div>;
}

export function ProjectGallery() {
  const [filter, setFilter] = useState<typeof filters[number]>("All projects");
  const visible = projects.filter(project => filter === "All projects" || project.category.toLowerCase().includes(filter.toLowerCase()));
  return <>
    <div className="project-toolbar"><div className="filters" aria-label="Filter projects">{filters.map(item => <button key={item} aria-pressed={filter === item} onClick={() => setFilter(item)}>{item}</button>)}</div><span className="project-count" aria-live="polite">{visible.length.toString().padStart(2, "0")} projects</span></div>
    <div className="project-grid">{visible.map(project => <article className="project-card" key={project.id}>
      <ProjectArt project={project}/>
      <div className="project-body"><div className="project-kicker">{project.category}{project.featured && <span>★ Award-winning capstone</span>}</div><h3>{project.title}</h3><p className="project-role">{project.role}</p><p>{project.description}</p><div className="tags">{project.tags.map(tag => <span key={tag}>{tag}</span>)}</div><div className="project-links">{project.githubUrl && <a href={project.githubUrl} target="_blank" rel="noopener noreferrer">Source code ↗</a>}{project.liveUrl && <a href={project.liveUrl} target="_blank" rel="noopener noreferrer">Live project ↗</a>}{!project.githubUrl && !project.liveUrl && <span>Project links coming soon <span aria-hidden="true">↗</span></span>}</div></div>
      <ProjectDemo project={project} />
    </article>)}</div>
  </>;
}
