import React from "react";
import PageHeader from "../components/kipl/PageHeader";
import ContactForm from "../components/sections/ContactForm";
import GlobalCompliance from "../components/sections/GlobalCompliance";

export default function ContactPage() {
  return (
    <div data-testid="contact-page">
      <PageHeader
        eyebrow="Global Inquiry"
        title="Let's engineer your next molecule."
        sub="Export desks, custom synthesis, or specification requests — one form, one team, one business day."
        testId="contact-page-header"
      />
      <ContactForm />
      <GlobalCompliance />
    </div>
  );
}
