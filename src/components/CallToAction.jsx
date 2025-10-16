import {Link} from "react-router-dom";

export default function CallToAction() {
  return (
    <section className="bg-red-600 text-white py-12 px-6 text-center">
      <h2 className="text-3xl font-bold mb-4">Ready to gear up?</h2>
      <p className="mb-6">
        Explore our full collection of tactical blades and gear.
      </p>
      <Link to="/shop" className="bg-white text-red-600 px-6 py-2 rounded hover:bg-gray-200">
        Browse Shop
    </Link>
    </section>
  );
}
