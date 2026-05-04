import React from "react";
import { motion, useScroll, useSpring } from "framer-motion";

export const ScrollProgress = () => {
  const { scrollYProgress } = useScroll();
  const x = useSpring(scrollYProgress, { stiffness: 120, damping: 30, mass: 0.4 });

  return (
    <motion.div
      aria-hidden="true"
      style={{ scaleX: x, transformOrigin: "0% 50%" }}
      className="fixed top-0 left-0 right-0 z-[60] h-[2px] bg-kipl-emerald shadow-[0_0_12px_rgba(16,185,129,0.55)] pointer-events-none"
      data-testid="scroll-progress"
    />
  );
};

export default ScrollProgress;
