import React, { useState } from 'react';
import { Trash2, Plus, Minus, ShoppingCart, Receipt, LogOut, DollarSign, TrendingUp } from 'lucide-react';
import { BarChart, Bar, XAxis, YAxis, CartesianGrid, Tooltip, ResponsiveContainer, PieChart, Pie, Cell } from 'recharts';

const PRODUCTS = [
  { id: 1, name: 'Banana', price: 40, category: 'Fruits', image: '🍌', stock: 50 },
  { id: 2, name: 'Apple', price: 50, category: 'Fruits', image: '🍎', stock: 40 },
  { id: 3, name: 'Chiku', price: 30, category: 'Fruits', image: '🍐', stock: 35 },
  { id: 4, name: 'Pineapple', price: 35, category: 'Fruits', image: '🍍', stock: 25 },
  { id: 5, name: 'Cherry', price: 55, category: 'Fruits', image: '🍒', stock: 20 },
  { id: 6, name: 'Kiwi', price: 70, category: 'Fruits', image: '🥝', stock: 30 },
  { id: 7, name: 'Mango', price: 100, category: 'Fruits', image: '🥭', stock: 45 },
  { id: 8, name: 'Grapes', price: 65, category: 'Fruits', image: '🍇', stock: 38 },
];

const PAYMENT_METHODS = ['Cash', 'Card', 'UPI', 'Wallet'];
const DISCOUNT_TYPES = ['None', 'Percentage', 'Fixed Amount'];
const COLORS = ['#9333ea', '#ec4899', '#06b6d4', '#10b981'];

export default function POSSystem() {
  const [currentUser, setCurrentUser] = useState(null);
  const [cart, setCart] = useState([]);
  const [showBill, setShowBill] = useState(false);
  const [showDashboard, setShowDashboard] = useState(false);
  const [searchTerm, setSearchTerm] = useState('');
  const [discount, setDiscount] = useState({ type: 'None', value: 0 });
  const [transactions, setTransactions] = useState([]);
  const [customerName, setCustomerName] = useState('');
  const [customerPhone, setCustomerPhone] = useState('');

  const calculateSubtotal = () => cart.reduce((sum, item) => sum + (item.price * item.qty), 0);

  const calculateDiscount = () => {
    const subtotal = calculateSubtotal();
    if (discount.type === 'Percentage') return (subtotal * discount.value) / 100;
    if (discount.type === 'Fixed Amount') return discount.value;
    return 0;
  };

  const calculateTax = () => {
    const taxableAmount = calculateSubtotal() - calculateDiscount();
    return taxableAmount * 0.05;
  };

  const calculateTotal = () => calculateSubtotal() - calculateDiscount() + calculateTax();

  const addToCart = (product) => {
    setCart(prev => {
      const existing = prev.find(item => item.id === product.id);
      if (existing) {
        return prev.map(item =>
          item.id === product.id ? { ...item, qty: item.qty + 1 } : item
        );
      }
      return [...prev, { ...product, qty: 1 }];
    });
  };

  const updateQuantity = (id, qty) => {
    if (qty <= 0) {
      removeFromCart(id);
    } else {
      setCart(prev => prev.map(item => item.id === id ? { ...item, qty } : item));
    }
  };

  const removeFromCart = (id) => {
    setCart(prev => prev.filter(item => item.id !== id));
  };

  const completePurchase = (finalPaymentMethod) => {
    if (cart.length === 0) return;

    const transaction = {
      id: Date.now(),
      date: new Date().toLocaleDateString(),
      time: new Date().toLocaleTimeString(),
      items: cart,
      subtotal: calculateSubtotal(),
      discount: calculateDiscount(),
      tax: calculateTax(),
      total: calculateTotal(),
      paymentMethod: finalPaymentMethod,
      customerName: customerName || 'Walk-in Customer',
      customerPhone,
    };

    setTransactions(prev => [transaction, ...prev]);
    setCart([]);
    setCustomerName('');
    setCustomerPhone('');
    setShowBill(false);
  };

  if (!currentUser) {
    return <LoginScreen onLogin={setCurrentUser} />;
  }

  if (showDashboard) {
    return (
      <DashboardView
        transactions={transactions}
        user={currentUser}
        onLogout={() => setCurrentUser(null)}
        onBack={() => setShowDashboard(false)}
      />
    );
  }

  return (
    <div className="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white">
      <header className="bg-black/50 backdrop-blur-md border-b border-slate-700 sticky top-0 z-40">
        <div className="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
          <div className="flex items-center gap-3">
            <div className="w-10 h-10 bg-gradient-to-br from-purple-500 to-pink-500 rounded-lg flex items-center justify-center">
              <ShoppingCart size={24} />
            </div>
            <div>
              <h1 className="text-2xl font-bold">ProBill</h1>
              <p className="text-xs text-slate-400">Professional POS System</p>
            </div>
          </div>
          <div className="flex items-center gap-4">
            <span className="text-sm text-slate-300">Welcome, {currentUser.name}</span>
            <button
              onClick={() => setShowDashboard(true)}
              className="p-2 hover:bg-slate-700 rounded-lg transition"
            >
              <TrendingUp size={20} />
            </button>
            <button
              onClick={() => setCurrentUser(null)}
              className="p-2 hover:bg-red-900/30 rounded-lg transition"
            >
              <LogOut size={20} />
            </button>
          </div>
        </div>
      </header>

      <main className="max-w-7xl mx-auto px-6 py-8">
        <div className="grid grid-cols-1 lg:grid-cols-3 gap-8">
          <div className="lg:col-span-2">
            <div className="bg-slate-800/50 backdrop-blur border border-slate-700 rounded-xl p-6">
              <div className="mb-6">
                <h2 className="text-xl font-bold mb-4">Products</h2>
                <input
                  type="text"
                  placeholder="🔍 Search products..."
                  value={searchTerm}
                  onChange={(e) => setSearchTerm(e.target.value)}
                  className="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:border-purple-500 transition"
                />
              </div>

              <div className="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4 max-h-[600px] overflow-y-auto">
                {PRODUCTS.filter(p => p.name.toLowerCase().includes(searchTerm.toLowerCase())).map(product => (
                  <button
                    key={product.id}
                    onClick={() => addToCart(product)}
                    className="group bg-slate-700/30 hover:bg-slate-700/60 border border-slate-600 hover:border-purple-500 rounded-lg p-4 transition transform hover:scale-105 active:scale-95"
                  >
                    <div className="text-4xl mb-2">{product.image}</div>
                    <h3 className="font-semibold text-sm group-hover:text-purple-400 transition">{product.name}</h3>
                    <p className="text-xs text-slate-400 mb-2">₹{product.price}</p>
                    <div className="flex items-center justify-between text-xs">
                      <span className="text-slate-400">Stock: {product.stock}</span>
                      <Plus size={16} className="group-hover:text-purple-400" />
                    </div>
                  </button>
                ))}
              </div>
            </div>
          </div>

          <div className="lg:col-span-1">
            <div className="bg-gradient-to-b from-slate-800/50 to-slate-900/50 backdrop-blur border border-slate-700 rounded-xl p-6 sticky top-24">
              <h2 className="text-xl font-bold mb-4 flex items-center gap-2">
                <ShoppingCart size={20} />
                Cart ({cart.length})
              </h2>

              <div className="space-y-3 mb-4 max-h-64 overflow-y-auto">
                {cart.length === 0 ? (
                  <p className="text-center text-slate-400 py-8">No items in cart</p>
                ) : (
                  cart.map(item => (
                    <div key={item.id} className="bg-slate-700/30 rounded-lg p-3 border border-slate-600">
                      <div className="flex justify-between items-start mb-2">
                        <span className="font-semibold text-sm">{item.name}</span>
                        <button
                          onClick={() => removeFromCart(item.id)}
                          className="text-red-400 hover:text-red-300 transition"
                        >
                          <Trash2 size={14} />
                        </button>
                      </div>
                      <div className="flex items-center justify-between text-sm">
                        <span className="text-slate-400">₹{item.price}</span>
                        <div className="flex items-center gap-2 bg-slate-600/50 rounded px-2 py-1">
                          <button
                            onClick={() => updateQuantity(item.id, item.qty - 1)}
                            className="hover:text-purple-400 transition"
                          >
                            <Minus size={14} />
                          </button>
                          <span className="w-6 text-center">{item.qty}</span>
                          <button
                            onClick={() => updateQuantity(item.id, item.qty + 1)}
                            className="hover:text-purple-400 transition"
                          >
                            <Plus size={14} />
                          </button>
                        </div>
                      </div>
                      <div className="text-right text-purple-400 font-semibold mt-2">
                        ₹{(item.price * item.qty).toLocaleString()}
                      </div>
                    </div>
                  ))
                )}
              </div>

              {cart.length > 0 && (
                <div className="space-y-3 mb-4">
                  <input
                    type="text"
                    placeholder="Customer name (optional)"
                    value={customerName}
                    onChange={(e) => setCustomerName(e.target.value)}
                    className="w-full px-3 py-2 bg-slate-700/50 border border-slate-600 rounded text-sm text-white placeholder-slate-400 focus:outline-none focus:border-purple-500"
                  />
                  <input
                    type="text"
                    placeholder="Phone (optional)"
                    value={customerPhone}
                    onChange={(e) => setCustomerPhone(e.target.value)}
                    className="w-full px-3 py-2 bg-slate-700/50 border border-slate-600 rounded text-sm text-white placeholder-slate-400 focus:outline-none focus:border-purple-500"
                  />
                </div>
              )}

              {cart.length > 0 && (
                <div className="bg-slate-700/20 rounded-lg p-3 mb-4 border border-slate-600">
                  <label className="text-xs font-semibold text-slate-300 block mb-2">Apply Discount</label>
                  <select
                    value={discount.type}
                    onChange={(e) => setDiscount({ ...discount, type: e.target.value, value: 0 })}
                    className="w-full px-2 py-1 bg-slate-700/50 border border-slate-600 rounded text-sm mb-2 focus:outline-none focus:border-purple-500 text-white"
                  >
                    {DISCOUNT_TYPES.map(type => (
                      <option key={type} value={type}>{type}</option>
                    ))}
                  </select>
                  {discount.type !== 'None' && (
                    <input
                      type="number"
                      placeholder={discount.type === 'Percentage' ? 'Enter %' : 'Enter amount'}
                      value={discount.value}
                      onChange={(e) => setDiscount({ ...discount, value: parseFloat(e.target.value) || 0 })}
                      className="w-full px-2 py-1 bg-slate-700/50 border border-slate-600 rounded text-sm focus:outline-none focus:border-purple-500 text-white"
                    />
                  )}
                </div>
              )}

              {cart.length > 0 && (
                <div className="space-y-2 text-sm mb-4 pb-4 border-b border-slate-600">
                  <div className="flex justify-between text-slate-300">
                    <span>Subtotal</span>
                    <span>₹{calculateSubtotal().toLocaleString()}</span>
                  </div>
                  {calculateDiscount() > 0 && (
                    <div className="flex justify-between text-green-400">
                      <span>Discount</span>
                      <span>-₹{calculateDiscount().toLocaleString()}</span>
                    </div>
                  )}
                  <div className="flex justify-between text-slate-300">
                    <span>Tax (5%)</span>
                    <span>₹{calculateTax().toLocaleString()}</span>
                  </div>
                  <div className="flex justify-between text-lg font-bold text-purple-400 pt-2">
                    <span>Total</span>
                    <span>₹{calculateTotal().toLocaleString()}</span>
                  </div>
                </div>
              )}

              <div className="space-y-2">
                <button
                  onClick={() => setShowBill(true)}
                  disabled={cart.length === 0}
                  className="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 disabled:opacity-50 disabled:cursor-not-allowed py-3 rounded-lg font-semibold transition transform hover:scale-105 active:scale-95"
                >
                  Proceed to Payment
                </button>
                <button
                  onClick={() => setCart([])}
                  disabled={cart.length === 0}
                  className="w-full bg-slate-700 hover:bg-slate-600 disabled:opacity-50 disabled:cursor-not-allowed py-2 rounded-lg text-sm transition"
                >
                  Clear Cart
                </button>
              </div>
            </div>
          </div>
        </div>
      </main>

      {showBill && (
        <PaymentModal
          total={calculateTotal()}
          subtotal={calculateSubtotal()}
          discount={calculateDiscount()}
          tax={calculateTax()}
          items={cart}
          onComplete={completePurchase}
          onCancel={() => setShowBill(false)}
          paymentMethods={PAYMENT_METHODS}
        />
      )}
    </div>
  );
}

function LoginScreen({ onLogin }) {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');

  const handleLogin = () => {
    if (email && password) {
      onLogin({ name: email.split('@')[0], email });
    }
  };

  return (
    <div className="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 flex items-center justify-center">
      <div className="w-full max-w-md">
        <div className="bg-slate-800/50 backdrop-blur border border-slate-700 rounded-2xl p-8">
          <div className="text-center mb-8">
            <div className="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-xl flex items-center justify-center mx-auto mb-4">
              <ShoppingCart size={32} className="text-white" />
            </div>
            <h1 className="text-3xl font-bold text-white">ProBill</h1>
            <p className="text-slate-400 text-sm mt-2">Professional POS System</p>
          </div>

          <div className="space-y-4">
            <input
              type="email"
              placeholder="Email"
              value={email}
              onChange={(e) => setEmail(e.target.value)}
              onKeyPress={(e) => e.key === 'Enter' && handleLogin()}
              className="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:border-purple-500 transition"
            />
            <input
              type="password"
              placeholder="Password"
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              onKeyPress={(e) => e.key === 'Enter' && handleLogin()}
              className="w-full px-4 py-3 bg-slate-700/50 border border-slate-600 rounded-lg text-white placeholder-slate-400 focus:outline-none focus:border-purple-500 transition"
            />
            <button
              onClick={handleLogin}
              className="w-full bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 py-3 rounded-lg font-semibold transition transform hover:scale-105 active:scale-95"
            >
              Login
            </button>
          </div>

          <p className="text-center text-slate-400 text-sm mt-6">Demo: Use any email/password</p>
        </div>
      </div>
    </div>
  );
}

function PaymentModal({ total, subtotal, discount, tax, items, onComplete, onCancel, paymentMethods }) {
  const [selectedMethod, setSelectedMethod] = useState('Cash');
  const [amountReceived, setAmountReceived] = useState(total);

  const change = amountReceived - total;

  return (
    <div className="fixed inset-0 bg-black/80 backdrop-blur flex items-center justify-center z-50">
      <div className="bg-slate-800 border border-slate-700 rounded-xl p-8 max-w-md w-full mx-4 max-h-[90vh] overflow-y-auto">
        <h2 className="text-2xl font-bold mb-6 flex items-center gap-2">
          <Receipt size={24} />
          Payment
        </h2>

        <div className="bg-slate-700/30 rounded-lg p-4 mb-6 border border-slate-600">
          <div className="space-y-2 text-sm mb-3">
            <div className="flex justify-between text-slate-300">
              <span>Subtotal</span>
              <span>₹{subtotal.toLocaleString()}</span>
            </div>
            {discount > 0 && (
              <div className="flex justify-between text-green-400">
                <span>Discount</span>
                <span>-₹{discount.toLocaleString()}</span>
              </div>
            )}
            <div className="flex justify-between text-slate-300">
              <span>Tax</span>
              <span>₹{tax.toLocaleString()}</span>
            </div>
          </div>
          <div className="border-t border-slate-600 pt-3">
            <div className="flex justify-between text-lg font-bold text-purple-400">
              <span>Total Payable</span>
              <span>₹{total.toLocaleString()}</span>
            </div>
          </div>
        </div>

        <div className="mb-6">
          <label className="block text-sm font-semibold mb-2">Payment Method</label>
          <div className="grid grid-cols-2 gap-2">
            {paymentMethods.map(method => (
              <button
                key={method}
                onClick={() => setSelectedMethod(method)}
                className={`py-2 rounded-lg font-semibold transition ${
                  selectedMethod === method
                    ? 'bg-purple-600 text-white'
                    : 'bg-slate-700/30 text-slate-300 hover:bg-slate-700/50'
                }`}
              >
                {method}
              </button>
            ))}
          </div>
        </div>

        {selectedMethod === 'Cash' && (
          <div className="mb-6">
            <label className="block text-sm font-semibold mb-2">Amount Received</label>
            <input
              type="number"
              value={amountReceived}
              onChange={(e) => setAmountReceived(parseFloat(e.target.value) || 0)}
              className="w-full px-4 py-2 bg-slate-700/50 border border-slate-600 rounded-lg text-white focus:outline-none focus:border-purple-500"
            />
            {change > 0 && (
              <div className="mt-2 p-2 bg-green-900/30 rounded border border-green-700/50">
                <p className="text-sm text-green-400">Change: ₹{change.toLocaleString()}</p>
              </div>
            )}
            {change < 0 && (
              <div className="mt-2 p-2 bg-red-900/30 rounded border border-red-700/50">
                <p className="text-sm text-red-400">Insufficient amount!</p>
              </div>
            )}
          </div>
        )}

        <div className="flex gap-3">
          <button
            onClick={onCancel}
            className="flex-1 px-4 py-2 bg-slate-700 hover:bg-slate-600 rounded-lg font-semibold transition"
          >
            Cancel
          </button>
          <button
            onClick={() => onComplete(selectedMethod)}
            disabled={selectedMethod === 'Cash' && change < 0}
            className="flex-1 px-4 py-3 bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 disabled:opacity-50 disabled:cursor-not-allowed rounded-lg font-semibold transition"
          >
            Complete Sale
          </button>
        </div>
      </div>
    </div>
  );
}

function DashboardView({ transactions, user, onLogout, onBack }) {
  const totalSales = transactions.reduce((sum, t) => sum + t.total, 0);
  const totalTransactions = transactions.length;
  const totalItems = transactions.reduce((sum, t) => sum + t.items.reduce((s, i) => s + i.qty, 0), 0);

  const paymentMethodData = PAYMENT_METHODS.map(method => ({
    name: method,
    value: transactions.filter(t => t.paymentMethod === method).length
  })).filter(d => d.value > 0);

  const dailySalesData = transactions.reduce((acc, t) => {
    const existing = acc.find(d => d.date === t.date);
    if (existing) {
      existing.sales += t.total;
    } else {
      acc.push({ date: t.date, sales: t.total });
    }
    return acc;
  }, []);

  return (
    <div className="min-h-screen bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white">
      <header className="bg-black/50 backdrop-blur-md border-b border-slate-700">
        <div className="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
          <h1 className="text-2xl font-bold">Dashboard</h1>
          <button
            onClick={onBack}
            className="px-4 py-2 bg-slate-700 hover:bg-slate-600 rounded-lg transition"
          >
            Back to POS
          </button>
        </div>
      </header>

      <main className="max-w-7xl mx-auto px-6 py-8">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
          <div className="bg-slate-800/50 border border-slate-700 rounded-xl p-6">
            <div className="flex items-center justify-between">
              <div>
                <p className="text-slate-400 text-sm">Total Sales</p>
                <p className="text-3xl font-bold mt-2">₹{totalSales.toLocaleString()}</p>
              </div>
              <DollarSign className="text-purple-500" size={32} />
            </div>
          </div>
          <div className="bg-slate-800/50 border border-slate-700 rounded-xl p-6">
            <div className="flex items-center justify-between">
              <div>
                <p className="text-slate-400 text-sm">Transactions</p>
                <p className="text-3xl font-bold mt-2">{totalTransactions}</p>
              </div>
              <Receipt className="text-pink-500" size={32} />
            </div>
          </div>
          <div className="bg-slate-800/50 border border-slate-700 rounded-xl p-6">
            <div className="flex items-center justify-between">
              <div>
                <p className="text-slate-400 text-sm">Items Sold</p>
                <p className="text-3xl font-bold mt-2">{totalItems}</p>
              </div>
              <ShoppingCart className="text-cyan-500" size={32} />
            </div>
          </div>
          <div className="bg-slate-800/50 border border-slate-700 rounded-xl p-6">
            <div className="flex items-center justify-between">
              <div>
                <p className="text-slate-400 text-sm">Avg Transaction</p>
                <p className="text-3xl font-bold mt-2">₹{(totalTransactions > 0 ? totalSales / totalTransactions : 0).toLocaleString()}</p>
              </div>
              <TrendingUp className="text-green-500" size={32} />
            </div>
          </div>
        </div>

        <div className="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
          <div className="bg-slate-800/50 border border-slate-700 rounded-xl p-6">
            <h2 className="text-lg font-bold mb-4">Daily Sales Trend</h2>
            <ResponsiveContainer width="100%" height={300}>
              <BarChart data={dailySalesData}>
                <CartesianGrid strokeDasharray="3 3" stroke="#475569" />
                <XAxis dataKey="date" stroke="#94a3b8" />
                <YAxis stroke="#94a3b8" />
                <Tooltip contentStyle={{ backgroundColor: '#1e293b', border: '1px solid #475569' }} />
                <Bar dataKey="sales" fill="#9333ea" radius={[8, 8, 0, 0]} />
              </BarChart>
            </ResponsiveContainer>
          </div>

          <div className="bg-slate-800/50 border border-slate-700 rounded-xl p-6">
            <h2 className="text-lg font-bold mb-4">Payment Methods</h2>
            {paymentMethodData.length > 0 ? (
              <ResponsiveContainer width="100%" height={300}>
                <PieChart>
                  <Pie data={paymentMethodData} cx="50%" cy="50%" labelLine={false} label outerRadius={80} dataKey="value">
                    {paymentMethodData.map((entry, index) => (
                      <Cell key={`cell-${index}`} fill={COLORS[index % COLORS.length]} />
                    ))}
                  </Pie>
                </PieChart>
              </ResponsiveContainer>
            ) : (
              <p className="text-center text-slate-400 py-20">No transaction data yet</p>
            )}
          </div>
        </div>

        <div className="bg-slate-800/50 border border-slate-700 rounded-xl p-6">
          <h2 className="text-lg font-bold mb-4">Recent Transactions</h2>
          {transactions.length === 0 ? (
            <p className="text-center text-slate-400 py-8">No transactions yet</p>
          ) : (
            <div className="overflow-x-auto">
              <table className="w-full text-sm">
                <thead>
                  <tr className="border-b border-slate-700">
                    <th className="text-left py-2 px-4">Date</th>
                    <th className="text-left py-2 px-4">Customer</th>
                    <th className="text-left py-2 px-4">Items</th>
                    <th className="text-left py-2 px-4">Amount</th>
                    <th className="text-left py-2 px-4">Payment</th>
                  </tr>
                </thead>
                <tbody>
                  {transactions.slice(0, 10).map(t => (
                    <tr key={t.id} className="border-b border-slate-700/50 hover:bg-slate-700/20">
                      <td className="py-2 px-4">{t.date}</td>
                      <td className="py-2 px-4">{t.customerName}</td>
                      <td className="py-2 px-4">{t.items.length}</td>
                      <td className="py-2 px-4 text-purple-400 font-semibold">₹{t.total.toLocaleString()}</td>
                      <td className="py-2 px-4">{t.paymentMethod}</td>
                    </tr>
                  ))}
                </tbody>
              </table>
            </div>
          )}
        </div>
      </main>
    </div>
  );
}