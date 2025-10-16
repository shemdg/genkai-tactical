import { Link } from "react-router-dom";
import { useCart } from "../context/CartContext";
import { useState } from "react";

export default function Navbar() {
  const { cart } = useCart();
  const [open, setOpen] = useState(false);

  return (
    <nav className="bg-black text-white px-6 py-4 flex justify-between items-center relative">
      <Link to="/" className="text-2xl font-bold">
        Genkai Tactical
      </Link>

      <div className="space-x-4 flex items-center">
        <Link to="/" className="hover:text-red-500">
          Home
        </Link>
        <Link to="/shop" className="hover:text-red-500">
          Shop
        </Link>
        <Link to="/about" className="hover:text-red-500">
          About
        </Link>
        <Link to="/contact" className="hover:text-red-500">
          Contact
        </Link>

        {/* Cart Dropdown */}
        <div
          className="relative"
          onMouseEnter={() => setOpen(true)}
          onMouseLeave={() => setOpen(false)}
        >
          <Link to="/cart" className="hover:text-red-500">
            Cart ({cart.reduce((sum, item) => sum + item.quantity, 0)})
          </Link>

          {open && cart.length > 0 && (
            <div className="absolute right-0 mt-2 w-64 bg-white text-black shadow-lg rounded p-4 z-50">
              <h3 className="font-bold mb-2">Mini Cart</h3>
              <ul className="space-y-2 max-h-60 overflow-y-auto">
                {cart.map((item) => (
                  <li key={item.id} className="flex justify-between">
                    <span>
                      {item.name} × {item.quantity}
                    </span>
                    <span className="text-red-600">
                      ₱{(item.price * item.quantity).toFixed(2)}
                    </span>
                  </li>
                ))}
              </ul>
              <div className="mt-3 flex justify-between items-center">
                <span className="font-bold">
                  Total: ₱
                  {cart
                    .reduce((sum, item) => sum + item.price * item.quantity, 0)
                    .toFixed(2)}
                </span>
                <Link
                  to="/cart"
                  className="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700"
                >
                  View Cart
                </Link>
              </div>
            </div>
          )}
        </div>
      </div>
    </nav>
  );
}
