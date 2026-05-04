import React from "react";
import PageHeader from "../components/kipl/PageHeader";
import Sustainability from "../components/sections/Sustainability";
import GlobalCompliance from "../components/sections/GlobalCompliance";
import ContactForm from "../components/sections/ContactForm";

export default function SustainabilityPage() {
  return (
    <div data-testid="sustainability-page">
      <PageHeader
        eyebrow="ESG · Responsibility"
        title="Chemistry for a cleaner century."
        sub="How KIPL balances molecular precision with environmental stewardship — across every reactor, column, and supplier."
        testId="sustainability-page-header"
      />
      <Sustainability />
      <GlobalCompliance />
      <ContactForm compact />
    </div>
  );
}
