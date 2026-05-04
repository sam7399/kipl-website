import React, { useState } from "react";
import { motion } from "framer-motion";
import { MapPin, Mail, Phone, ArrowRight, Loader2, CheckCircle2 } from "lucide-react";
import { toast } from "sonner";
import SectionHeader from "../kipl/SectionHeader";
import { INDUSTRY_OPTIONS, INQUIRY_TYPES } from "../../lib/data";
import { submitInquiry } from "../../lib/api";
import { fadeUp, viewportOnce } from "../../lib/animations";

const initialForm = {
  name: "",
  email: "",
  company: "",
  industry: "",
  inquiry_type: "",
  message: "",
  website: "", // honeypot — must remain empty
};

export const ContactForm = ({ compact = false }) => {
  const [form, setForm] = useState(initialForm);
  const [loading, setLoading] = useState(false);
  const [reference, setReference] = useState(null);

  const onChange = (k) => (e) => setForm((f) => ({ ...f, [k]: e.target.value }));

  const onSubmit = async (e) => {
    e.preventDefault();
    if (
      !form.name ||
      !form.email ||
      !form.company ||
      !form.industry ||
      !form.inquiry_type ||
      !form.message
    ) {
      toast.error("Please complete every field before sending.");
      return;
    }

    setLoading(true);
    try {
      const result = await submitInquiry(form);
      setReference(result?.reference || "received");
      setForm(initialForm);
      toast.success("Inquiry received. Our team will respond within one business day.");
    } catch (err) {
      const detail = err?.detail || err?.message || "Could not submit inquiry. Please try again.";
      toast.error(typeof detail === "string" ? detail : "Submission failed.");
    } finally {
      setLoading(false);
    }
  };

  return (
    <section
      id="contact"
      className={`relative ${compact ? "py-20" : "py-24 md:py-32"} bg-white`}
      data-testid="contact-section"
    >
      <div className="max-w-7xl mx-auto px-6 md:px-10">
        <div className="grid grid-cols-1 lg:grid-cols-12 gap-12">
          <div className="lg:col-span-5 flex flex-col gap-10">
            <SectionHeader
              eyebrow="Contact · Global Inquiry"
              title="Partner with KIPL."
              sub="Connect with our team to discuss custom manufacturing, product specifications, or global export inquiries."
              testId="contact-header"
            />

            <motion.div
              variants={fadeUp}
              initial="hidden"
              whileInView="show"
              viewport={viewportOnce}
              className="rounded-3xl bg-kipl-navy text-white p-8 md:p-10 relative overflow-hidden"
              data-testid="contact-locations"
            >
              <div className="absolute -right-20 -top-20 w-64 h-64 rounded-full bg-kipl-emerald/10 blur-3xl" />
              <h4 className="font-display font-bold text-xl">Global Offices</h4>
              <div className="mt-6 space-y-6">
                <div className="flex gap-4">
                  <div className="w-10 h-10 rounded-xl bg-kipl-emerald/15 text-kipl-emerald flex items-center justify-center flex-shrink-0">
                    <MapPin className="w-5 h-5" />
                  </div>
                  <div>
                    <div className="text-xs tracking-[0.22em] uppercase text-kipl-emerald font-semibold">
                      Headquarters
                    </div>
                    <div className="mt-1 font-display text-lg font-semibold">Mumbai, Maharashtra</div>
                    <div className="text-sm text-white/60">India</div>
                  </div>
                </div>
                <div className="flex gap-4">
                  <div className="w-10 h-10 rounded-xl bg-kipl-emerald/15 text-kipl-emerald flex items-center justify-center flex-shrink-0">
                    <MapPin className="w-5 h-5" />
                  </div>
                  <div>
                    <div className="text-xs tracking-[0.22em] uppercase text-kipl-emerald font-semibold">
                      Manufacturing
                    </div>
                    <div className="mt-1 font-display text-lg font-semibold">Dahej, Gujarat</div>
                    <div className="text-sm text-white/60">India</div>
                  </div>
                </div>
                <div className="pt-5 border-t border-white/10 flex flex-col gap-2 text-sm text-white/80">
                  <div className="flex items-center gap-3">
                    <Mail className="w-4 h-4 text-kipl-emerald" />
                    <a href="mailto:inquiry@krystalingredients.com" className="hover:text-white">
                      inquiry@krystalingredients.com
                    </a>
                  </div>
                  <div className="flex items-center gap-3">
                    <Phone className="w-4 h-4 text-kipl-emerald" />
                    <a href="tel:+912200000000" className="hover:text-white">
                      +91 22 0000 0000
                    </a>
                  </div>
                </div>
              </div>
            </motion.div>
          </div>

          <motion.form
            variants={fadeUp}
            initial="hidden"
            whileInView="show"
            viewport={viewportOnce}
            onSubmit={onSubmit}
            noValidate
            className="lg:col-span-7 rounded-3xl border border-slate-200 bg-kipl-slate p-8 md:p-10"
            data-testid="contact-form"
          >
            {reference ? (
              <div className="flex flex-col items-center text-center py-14" data-testid="contact-success">
                <div className="w-14 h-14 rounded-full bg-kipl-emerald/15 text-kipl-emerald flex items-center justify-center">
                  <CheckCircle2 className="w-7 h-7" />
                </div>
                <h3 className="mt-6 font-display font-bold text-2xl text-kipl-navy">
                  Inquiry received.
                </h3>
                <p className="mt-2 text-slate-600 max-w-md">
                  Our business team will respond within one business day. A confirmation email has
                  been dispatched to your inbox.
                </p>
                {reference !== "received" && (
                  <div className="mt-6 inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-2 font-mono text-xs tracking-[0.18em] text-kipl-navy">
                    Reference · {reference}
                  </div>
                )}
                <button
                  type="button"
                  onClick={() => setReference(null)}
                  className="mt-8 inline-flex items-center gap-2 text-sm font-semibold text-kipl-navy hover:text-kipl-emerald"
                  data-testid="contact-send-another"
                >
                  Send another inquiry
                  <ArrowRight className="w-4 h-4" />
                </button>
              </div>
            ) : (
              <>
                {/* Honeypot — hidden from users; bots fill it and get blocked server-side */}
                <div className="absolute left-[-9999px] top-auto w-px h-px overflow-hidden" aria-hidden="true">
                  <label htmlFor="website-trap">Leave this field empty</label>
                  <input
                    id="website-trap"
                    name="website"
                    type="text"
                    tabIndex={-1}
                    autoComplete="off"
                    value={form.website}
                    onChange={onChange("website")}
                  />
                </div>

                <div className="grid grid-cols-1 md:grid-cols-2 gap-5">
                  <Field label="Full name" htmlFor="name">
                    <input
                      id="name"
                      value={form.name}
                      onChange={onChange("name")}
                      type="text"
                      placeholder="e.g. Priya Sharma"
                      className="kipl-input"
                      data-testid="contact-input-name"
                      required
                      autoComplete="name"
                    />
                  </Field>
                  <Field label="Corporate email" htmlFor="email">
                    <input
                      id="email"
                      value={form.email}
                      onChange={onChange("email")}
                      type="email"
                      placeholder="priya@acme.com"
                      className="kipl-input"
                      data-testid="contact-input-email"
                      required
                      autoComplete="email"
                    />
                  </Field>
                  <Field label="Company name" htmlFor="company">
                    <input
                      id="company"
                      value={form.company}
                      onChange={onChange("company")}
                      type="text"
                      placeholder="Acme Fragrances Ltd."
                      className="kipl-input"
                      data-testid="contact-input-company"
                      required
                      autoComplete="organization"
                    />
                  </Field>
                  <Field label="Industry segment" htmlFor="industry">
                    <select
                      id="industry"
                      value={form.industry}
                      onChange={onChange("industry")}
                      className="kipl-input"
                      data-testid="contact-select-industry"
                      required
                    >
                      <option value="" disabled>Select industry</option>
                      {INDUSTRY_OPTIONS.map((i) => (
                        <option key={i} value={i}>{i}</option>
                      ))}
                    </select>
                  </Field>
                  <Field label="Inquiry type" htmlFor="inquiry_type" className="md:col-span-2">
                    <select
                      id="inquiry_type"
                      value={form.inquiry_type}
                      onChange={onChange("inquiry_type")}
                      className="kipl-input"
                      data-testid="contact-select-inquiry-type"
                      required
                    >
                      <option value="" disabled>Choose one</option>
                      {INQUIRY_TYPES.map((i) => (
                        <option key={i} value={i}>{i}</option>
                      ))}
                    </select>
                  </Field>
                  <Field label="Message" htmlFor="message" className="md:col-span-2">
                    <textarea
                      id="message"
                      value={form.message}
                      onChange={onChange("message")}
                      rows={5}
                      placeholder="Share volumes, target specifications, timelines or a product code…"
                      className="kipl-input resize-none"
                      data-testid="contact-input-message"
                      required
                    />
                  </Field>
                </div>

                <div className="mt-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                  <p className="text-xs text-slate-500">
                    By submitting, you agree to KIPL&apos;s privacy policy. We respond within one business day.
                  </p>
                  <button
                    type="submit"
                    disabled={loading}
                    className="inline-flex items-center justify-center gap-2 bg-kipl-navy text-white px-7 py-4 rounded-full text-sm font-semibold hover:bg-kipl-navy-2 hover:scale-[1.02] transition-all duration-300 disabled:opacity-60 disabled:cursor-wait"
                    data-testid="contact-submit-btn"
                  >
                    {loading ? (
                      <>
                        <Loader2 className="w-4 h-4 animate-spin" />
                        Sending…
                      </>
                    ) : (
                      <>
                        Request Consultation
                        <ArrowRight className="w-4 h-4" />
                      </>
                    )}
                  </button>
                </div>
              </>
            )}
          </motion.form>
        </div>
      </div>

      <style>{`
        .kipl-input {
          width: 100%;
          background: #ffffff;
          border: 1px solid #E2E8F0;
          color: #0A192F;
          padding: 14px 16px;
          border-radius: 12px;
          font-size: 14px;
          font-family: inherit;
          outline: none;
          transition: border-color .25s ease, box-shadow .25s ease;
        }
        .kipl-input::placeholder { color: #94A3B8; }
        .kipl-input:focus {
          border-color: #10B981;
          box-shadow: 0 0 0 4px rgba(16,185,129,0.12);
        }
      `}</style>
    </section>
  );
};

const Field = ({ label, htmlFor, children, className = "" }) => (
  <label htmlFor={htmlFor} className={`flex flex-col gap-2 ${className}`}>
    <span className="text-[11px] tracking-[0.22em] uppercase font-semibold text-kipl-navy/70">
      {label}
    </span>
    {children}
  </label>
);

export default ContactForm;
