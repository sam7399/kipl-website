import React from "react";
import Hero from "../components/sections/Hero";
import AboutGroup from "../components/sections/AboutGroup";
import ProductGrid from "../components/sections/ProductGrid";
import IndustriesBento from "../components/sections/IndustriesBento";
import DahejFacility from "../components/sections/DahejFacility";
import Sustainability from "../components/sections/Sustainability";
import RnDInnovation from "../components/sections/RnDInnovation";
import GlobalCompliance from "../components/sections/GlobalCompliance";
import ContactForm from "../components/sections/ContactForm";

export default function HomePage() {
  return (
    <div data-testid="home-page">
      <Hero />
      <AboutGroup />
      <ProductGrid />
      <IndustriesBento />
      <DahejFacility />
      <Sustainability />
      <RnDInnovation />
      <GlobalCompliance />
      <ContactForm />
    </div>
  );
}
