import React, { useEffect, useState } from "react";
import { Link, NavLink, useLocation } from "react-router-dom";
import { Menu, X, ArrowUpRight } from "lucide-react";
import { NAV_LINKS } from "../../lib/data";

export const StickyNavbar = () => {
  const [scrolled, setScrolled] = useState(false);
  const [open, setOpen] = useState(false);
  const location = useLocation();

  useEffect(() => {
    const onScroll = () => setScrolled(window.scrollY > 8);
    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
    return () => window.removeEventListener("scroll", onScroll);
  }, []);

  useEffect(() => {
    setOpen(false);
  }, [location.pathname]);

  return (
    <header
      className={`fixed top-0 inset-x-0 z-50 transition-all duration-300 ${
        scrolled
          ? "backdrop-blur-xl bg-kipl-navy/85 border-b border-white/10"
          : "bg-kipl-navy/50 backdrop-blur-md"
      }`}
      data-testid="sticky-navbar"
    >
      <div className="max-w-7xl mx-auto px-6 md:px-10 h-16 md:h-20 flex items-center justify-between">
        <Link to="/" className="flex items-center gap-3 group" data-testid="nav-logo">
          <div className="relative w-9 h-9">
            <svg viewBox="0 0 40 40" className="w-full h-full">
              <polygon
                points="20,3 35,12 35,28 20,37 5,28 5,12"
                fill="none"
                stroke="#10B981"
                strokeWidth="1.6"
              />
              <circle cx="20" cy="20" r="3" fill="#10B981" />
              <circle cx="12" cy="14" r="2" fill="#fff" />
              <circle cx="28" cy="14" r="2" fill="#fff" />
              <circle cx="12" cy="26" r="2" fill="#fff" />
              <circle cx="28" cy="26" r="2" fill="#fff" />
              <line x1="20" y1="20" x2="12" y2="14" stroke="#fff" strokeOpacity="0.5" />
              <line x1="20" y1="20" x2="28" y2="14" stroke="#fff" strokeOpacity="0.5" />
              <line x1="20" y1="20" x2="12" y2="26" stroke="#fff" strokeOpacity="0.5" />
              <line x1="20" y1="20" x2="28" y2="26" stroke="#fff" strokeOpacity="0.5" />
            </svg>
          </div>
          <div className="flex flex-col leading-tight">
            <span className="font-display text-white font-bold tracking-tight text-[17px]">KIPL</span>
            <span className="text-[10px] tracking-[0.22em] uppercase text-white/60 -mt-0.5">
              Krystal Ingredients
            </span>
          </div>
        </Link>

        <nav className="hidden lg:flex items-center gap-10">
          {NAV_LINKS.map((l) => (
            <NavLink
              key={l.to}
              to={l.to}
              className={({ isActive }) =>
                `text-sm font-medium transition-colors duration-200 ${
                  isActive ? "text-kipl-emerald" : "text-white/75 hover:text-white"
                }`
              }
              data-testid={`nav-link-${l.label.toLowerCase()}`}
            >
              {l.label}
            </NavLink>
          ))}
        </nav>

        <div className="flex items-center gap-3">
          <Link
            to="/contact"
            className="hidden md:inline-flex items-center gap-2 bg-kipl-emerald text-white px-5 py-2.5 rounded-full text-sm font-semibold hover:bg-kipl-emerald-dark hover:scale-[1.02] transition-all duration-300"
            data-testid="nav-cta-consult"
          >
            Request Consultation
            <ArrowUpRight className="w-4 h-4" />
          </Link>
          <button
            className="lg:hidden text-white p-2 rounded-full hover:bg-white/10 transition"
            onClick={() => setOpen((v) => !v)}
            aria-label="Toggle menu"
            data-testid="nav-mobile-toggle"
          >
            {open ? <X className="w-6 h-6" /> : <Menu className="w-6 h-6" />}
          </button>
        </div>
      </div>

      {/* mobile panel */}
      <div
        className={`lg:hidden overflow-hidden transition-[max-height,opacity] duration-500 ${
          open ? "max-h-96 opacity-100" : "max-h-0 opacity-0"
        } bg-kipl-navy/95 backdrop-blur-xl border-t border-white/10`}
        data-testid="nav-mobile-panel"
      >
        <div className="px-6 py-6 flex flex-col gap-5">
          {NAV_LINKS.map((l) => (
            <NavLink
              key={l.to}
              to={l.to}
              className={({ isActive }) =>
                `text-base font-medium ${isActive ? "text-kipl-emerald" : "text-white/80"}`
              }
              data-testid={`nav-mobile-link-${l.label.toLowerCase()}`}
            >
              {l.label}
            </NavLink>
          ))}
          <Link
            to="/contact"
            className="inline-flex items-center justify-center gap-2 bg-kipl-emerald text-white px-5 py-3 rounded-full text-sm font-semibold mt-2"
            data-testid="nav-mobile-cta"
          >
            Request Consultation
            <ArrowUpRight className="w-4 h-4" />
          </Link>
        </div>
      </div>
    </header>
  );
};

export default StickyNavbar;
