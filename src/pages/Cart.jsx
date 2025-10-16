import { useCart } from "../context/CartContext";
import {Link} from "react-router-dom";

export default function Cart() {
  const { cart, addToCart, decreaseQuantity, removeFromCart, clearCart } =
    useCart();

  const total = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);

  return (
    <div className="p-10">
      <h1 className="text-4xl font-bold text-center mb-10">Your Cart</h1>

      {cart.length === 0 ? (
        <section>
          <p className="text-center text-gray-600">Your cart is empty.</p>
          <section class="text-white py-12 px-6 text-center">
            <Link
              to="/shop"
              className="bg-red-600 text-white-600 px-6 py-2 rounded hover:bg-red-700"
            >
              Browse Shop
            </Link>
          </section>
        </section>
      ) : (
        <div className="space-y-6 max-w-2xl mx-auto">
          {cart.map((item) => (
            <div
              key={item.id}
              className="flex items-center justify-between border-b pb-4"
            >
              <div>
                <h2 className="text-xl font-semibold">{item.name}</h2>
                <p className="text-red-600 font-bold">
                  ₱{(item.price * item.quantity).toFixed(2)}
                </p>
                <p className="text-gray-500">₱{item.price} each</p>
              </div>

              <div className="flex items-center space-x-2">
                <button
                  onClick={() => decreaseQuantity(item.id)}
                  className="bg-gray-300 px-2 rounded hover:bg-gray-400"
                >
                  -
                </button>
                <span className="px-3">{item.quantity}</span>
                <button
                  onClick={() => addToCart(item)}
                  className="bg-gray-300 px-2 rounded hover:bg-gray-400"
                >
                  +
                </button>
                <button
                  onClick={() => removeFromCart(item.id)}
                  className="ml-4 bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700"
                >
                  Remove
                </button>
              </div>
            </div>
          ))}

          {/* Total Section */}
          <div className="flex justify-between items-center border-t pt-4">
            <h2 className="text-2xl font-bold">Total:</h2>
            <p className="text-2xl font-bold text-red-600">
              ₱{total.toFixed(2)}
            </p>
          </div>

          <div className="flex justify-between mt-6">
            <button
              onClick={clearCart}
              className="bg-black text-white px-6 py-2 rounded hover:bg-gray-800"
            >
              Clear Cart
            </button>
            <button className="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
              Checkout
            </button>
          </div>
        </div>
      )}
    </div>
  );
}
