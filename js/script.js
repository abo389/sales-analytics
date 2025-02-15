// WebSocket connection for real-time updates
const socket = new WebSocket( 'ws://127.0.0.1:8060' );
socket.binaryType = "arraybuffer"; // or "blob"

// DOM elements
const totalRevenueEl = document.getElementById( 'total-revenue' );
const revenueLastMinuteEl = document.getElementById( 'revenue-last-minute' );
const ordersLastMinuteEl = document.getElementById( 'orders-last-minute' );
const aiRecommendationEl = document.getElementById( 'ai-recommendation' );
const orderListEl = document.getElementById( 'order-list' );
const topProductsTableBody = document.querySelector( '#top-products-table tbody' );


// Fetch initial analytics data
fetch( 'http://localhost:8000/backend/api/analytics' )
  .then( ( response ) => response.json() )
  .then( ( data ) =>
  {
    updateAnalytics( data );
  } );

// Handle WebSocket messages
socket.addEventListener( 'message', ( event ) =>
{
  const data = JSON.parse( event.data );
  console.log( data );
  if ( data.type === "order" ) updateOrders( data.data );
  if ( data.type === 'analytic' ) updateAnalytics( data.data );
} );

function updateOrders (order)
{
  // Add new order to the list
  const orderItem = document.createElement( 'li' );
  orderItem.textContent = `Product ID: ${ order.product_id }, 
                            Quantity: ${ order.quantity }, 
                            Price: $${ order.price }
                            `;
  orderListEl.prepend( orderItem );
}

function updateAnalytics ( data )
{
  console.log(data)
  totalRevenueEl.textContent = `$${ data.total_revenue }`;
  revenueLastMinuteEl.textContent = `$${ data.last_minute_revenue || 0 }`;
  ordersLastMinuteEl.textContent = data.order_count_last_minute;

  // Clear existing rows in the table
  topProductsTableBody.innerHTML = '';
  
  // Add rows for top products
  data.top_products.forEach( ( product ) =>
  {
    const row = document.createElement( 'tr' );
    row.innerHTML = `
      <td>${ product.product_id }</td>
      <td>${ product.total_sold }</td>
    `;
    topProductsTableBody.appendChild( row );
  } );
}

// Fetch AI recommendations
fetch( 'http://localhost:8000/backend/api/recommendations' )
  .then( ( response ) => response.json() )
  .then( ( data ) =>
  {
    aiRecommendationEl.textContent = data.data;
  } );