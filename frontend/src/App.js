import React, { useEffect } from "react";
import { BrowserRouter, Routes, Route, useLocation } from "react-router-dom";
import { AnimatePresence, motion } from "framer-motion";
import { Toaster } from "sonner";
import "@/App.css";
import StickyNavbar from "@/components/kipl/StickyNavbar";
import MegaFooter from "@/components/kipl/MegaFooter";
import ScrollProgress from "@/components/kipl/ScrollProgress";
import HomePage from "@/pages/HomePage";
import ProductsPage from "@/pages/ProductsPage";
import ManufacturingPage from "@/pages/ManufacturingPage";
import SustainabilityPage from "@/pages/SustainabilityPage";
import ContactPage from "@/pages/ContactPage";

const ScrollToTop = () => {
  const { pathname } = useLocation();
  useEffect(() => {
    window.scrollTo({ top: 0, behavior: "instant" in window ? "instant" : "auto" });
  }, [pathname]);
  return null;
};

const PageTransition = ({ children }) => (
  <motion.div
    initial={{ opacity: 0, y: 12 }}
    animate={{ opacity: 1, y: 0 }}
    exit={{ opacity: 0, y: -8 }}
    transition={{ duration: 0.45, ease: [0.22, 1, 0.36, 1] }}
  >
    {children}
  </motion.div>
);

const RoutedApp = () => {
  const location = useLocation();
  return (
    <AnimatePresence mode="wait" initial={false}>
      <Routes location={location} key={location.pathname}>
        <Route path="/" element={<PageTransition><HomePage /></PageTransition>} />
        <Route path="/products" element={<PageTransition><ProductsPage /></PageTransition>} />
        <Route path="/manufacturing" element={<PageTransition><ManufacturingPage /></PageTransition>} />
        <Route path="/sustainability" element={<PageTransition><SustainabilityPage /></PageTransition>} />
        <Route path="/contact" element={<PageTransition><ContactPage /></PageTransition>} />
        <Route path="*" element={<PageTransition><HomePage /></PageTransition>} />
      </Routes>
    </AnimatePresence>
  );
};

function App() {
  return (
    <div className="App">
      <BrowserRouter>
        <ScrollToTop />
        <ScrollProgress />
        <StickyNavbar />
        <main>
          <RoutedApp />
        </main>
        <MegaFooter />
        <Toaster position="top-right" richColors closeButton theme="light" />
      </BrowserRouter>
    </div>
  );
}

export default App;
