import { knives } from "../data/knifeData";
import { useCart } from "../context/CartContext";

export default function Shop() {
  const { addToCart } = useCart();

  return (
    <div className="p-10">
      <h1 className="text-4xl font-bold text-center mb-10">Shop Blades</h1>
      <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
        {knives.map((knife) => (
          <div
            key={knife.id}
            className="border rounded-lg shadow hover:shadow-xl transition p-4"
          >
            <img
              src={knife.image}
              alt={knife.name}
              className="w-full h-48 object-cover rounded mb-4"
            />
            <h2 className="text-xl font-semibold">{knife.name}</h2>
            <p className="text-red-600 font-bold">₱{knife.price}</p>
            <button
              onClick={() => addToCart(knife)}
              className="mt-4 bg-black text-white px-4 py-2 rounded hover:bg-red-600 transition"
            >
              Add to Cart
            </button>
          </div>
        ))}
      </div>
    </div>
  );
}
