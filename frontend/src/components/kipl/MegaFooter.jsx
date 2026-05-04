import React from "react";
import { Link } from "react-router-dom";
import { MapPin, Mail, Phone, ArrowUpRight } from "lucide-react";

const year = new Date().getFullYear();

export const MegaFooter = () => {
  return (
    <footer className="relative bg-kipl-navy text-white/70 pt-20 pb-10 overflow-hidden" data-testid="mega-footer">
      <div className="absolute inset-0 pointer-events-none opacity-30">
        <div className="absolute -top-32 -left-24 w-96 h-96 rounded-full blur-3xl bg-kipl-emerald/10" />
        <div className="absolute bottom-0 right-0 w-[28rem] h-[28rem] rounded-full blur-3xl bg-sky-400/5" />
      </div>

      <div className="relative max-w-7xl mx-auto px-6 md:px-10 grid grid-cols-1 md:grid-cols-12 gap-10">
        <div className="md:col-span-5">
          <div className="flex items-center gap-3">
            <svg viewBox="0 0 40 40" className="w-9 h-9">
              <polygon
                points="20,3 35,12 35,28 20,37 5,28 5,12"
                fill="none"
                stroke="#10B981"
                strokeWidth="1.6"
              />
              <circle cx="20" cy="20" r="3" fill="#10B981" />
            </svg>
            <div className="font-display text-white text-2xl font-bold tracking-tight">
              Krystal Ingredients
            </div>
          </div>
          <p className="mt-6 text-white/60 max-w-md leading-relaxed">
            A next-generation specialty chemical manufacturer — a wholly-owned subsidiary of
            Gem Aromatics Ltd., engineered to meet the evolving demands of global markets.
          </p>
          <div className="mt-8 flex flex-col gap-2 text-sm">
            <div className="flex items-start gap-3">
              <MapPin className="w-4 h-4 text-kipl-emerald mt-0.5" />
              <span>Headquarters — Mumbai, Maharashtra, India</span>
            </div>
            <div className="flex items-start gap-3">
              <MapPin className="w-4 h-4 text-kipl-emerald mt-0.5" />
              <span>Manufacturing — Dahej, Gujarat, India</span>
            </div>
            <div className="flex items-start gap-3">
              <Mail className="w-4 h-4 text-kipl-emerald mt-0.5" />
              <a href="mailto:inquiry@krystalingredients.com" className="hover:text-white">
                inquiry@krystalingredients.com
              </a>
            </div>
            <div className="flex items-start gap-3">
              <Phone className="w-4 h-4 text-kipl-emerald mt-0.5" />
              <span>+91 22 0000 0000</span>
            </div>
          </div>
        </div>

        <div className="md:col-span-2">
          <h4 className="text-xs tracking-[0.22em] uppercase font-semibold text-white mb-5">Company</h4>
          <ul className="space-y-3 text-sm">
            <li><Link to="/" className="hover:text-white">Home</Link></li>
            <li><Link to="/manufacturing" className="hover:text-white">Manufacturing</Link></li>
            <li><Link to="/sustainability" className="hover:text-white">Sustainability</Link></li>
            <li><Link to="/contact" className="hover:text-white">Contact</Link></li>
          </ul>
        </div>

        <div className="md:col-span-2">
          <h4 className="text-xs tracking-[0.22em] uppercase font-semibold text-white mb-5">Solutions</h4>
          <ul className="space-y-3 text-sm">
            <li><Link to="/products" className="hover:text-white">Aroma Chemicals</Link></li>
            <li><Link to="/products" className="hover:text-white">Specialty Ingredients</Link></li>
            <li><Link to="/products" className="hover:text-white">Phenol Derivatives</Link></li>
            <li><Link to="/products" className="hover:text-white">Custom Manufacturing</Link></li>
          </ul>
        </div>

        <div className="md:col-span-3">
          <h4 className="text-xs tracking-[0.22em] uppercase font-semibold text-white mb-5">Partner with KIPL</h4>
          <p className="text-sm text-white/60 mb-4">
            Global export, custom synthesis and specification inquiries.
          </p>
          <Link
            to="/contact"
            className="inline-flex items-center gap-2 bg-kipl-emerald text-white px-5 py-3 rounded-full text-sm font-semibold hover:bg-kipl-emerald-dark hover:scale-[1.02] transition-all duration-300"
            data-testid="footer-cta-consult"
          >
            Request Consultation
            <ArrowUpRight className="w-4 h-4" />
          </Link>
        </div>
      </div>

      <div className="relative max-w-7xl mx-auto px-6 md:px-10 mt-16 pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between gap-4 text-xs text-white/40">
        <span>© {year} Krystal Ingredients Pvt. Ltd. — A subsidiary of Gem Aromatics Ltd.</span>
        <span className="font-mono">v1.0 · Engineered in India · Delivered globally</span>
      </div>
    </footer>
  );
};

export default MegaFooter;
