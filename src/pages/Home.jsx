import HeroBanner from "../components/HeroBanner";
import FeaturedKnives from "../components/FeaturedKnives";
import AboutSection from "../components/AboutSection";
import CallToAction from "../components/CallToAction";
import Footer from "../components/Footer";

export default function Home() {
  return (
    <>
      <HeroBanner />
      <FeaturedKnives />
      <AboutSection />
      <CallToAction />
      <Footer />
    </>
  );
}
