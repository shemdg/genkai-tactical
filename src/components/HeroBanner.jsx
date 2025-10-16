import { Link } from "react-router-dom";

export default function HeroBanner() {
  return (
    <section className="bg-black text-white py-20 px-6 text-center">
      <h1 className="text-5xl font-bold mb-4">Genkai Tactical</h1>
      <p className="text-lg mb-6">Precision. Power. Purpose.</p>
      <Link to="/shop" className="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded">
        Shop Now
      </Link>
    </section>
  );
}
