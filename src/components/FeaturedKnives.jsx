import { knives } from "../data/knifeData";

export default function FeaturedKnives() {
  return (
    <section className="py-12 px-6">
      <h2 className="text-3xl font-bold mb-6 text-center">Featured Blades</h2>
      <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        {knives.slice(0, 3).map((knife) => (
          <div
            key={knife.id}
            className="border rounded p-4 shadow hover:shadow-lg"
          >
            <img
              src={knife.image}
              alt={knife.name}
              className="w-full h-48 object-cover mb-4"
            />
            <h3 className="text-xl font-semibold">{knife.name}</h3>
            <p className="text-red-600 font-bold">₱{knife.price}</p>
          </div>
        ))}
      </div>
    </section>
  );
}
