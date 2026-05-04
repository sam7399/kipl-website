import React from "react";
import PageHeader from "../components/kipl/PageHeader";
import DahejFacility from "../components/sections/DahejFacility";
import RnDInnovation from "../components/sections/RnDInnovation";
import GlobalCompliance from "../components/sections/GlobalCompliance";
import ContactForm from "../components/sections/ContactForm";

export default function ManufacturingPage() {
  return (
    <div data-testid="manufacturing-page">
      <PageHeader
        eyebrow="Dahej, Gujarat · Live 2026"
        title="Continuous processing. Uncompromising precision."
        sub="Inside the ₹230 Cr Dahej facility — fully automated reactors, multi-stage distillation and a global-grade QC suite."
        testId="manufacturing-page-header"
      />
      <DahejFacility />
      <RnDInnovation />
      <GlobalCompliance />
      <ContactForm compact />
    </div>
  );
}
