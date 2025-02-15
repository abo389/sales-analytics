var socket = new WebSocket( "ws://127.0.0.1:8060" );
socket.onmessage = ( e ) => console.log( JSON.parse( e.data ) );

var products = [];
var quantities = [];

// Function to filter products by city
async function filterByCity ()
{
  const input = document.getElementById( "city-input" );
  const city = input.value;
  if ( city )
  {
    await initializeApp( city );
  } else
  {
    alert( "Please enter a city name." );
  }
}

// Function to fetch products based on city temperature
async function fetchProductsByCity ( city )
{
  try
  {
    const response = await fetch( `http://localhost:8000/backend/api/products?city=${ city }` );
    if ( !response.ok )
    {
      throw new Error( "Failed to fetch products" );
    }
    const data = await response.json();
    return data;
  } catch ( error )
  {
    console.error( "Error fetching products:", error );
    return [];
  }
}

// Function to render the table
function renderTable ()
{
  const tableBody = document.getElementById( "table-body" );
  tableBody.innerHTML = ""; // Clear the table before re-rendering

  products.forEach( ( product, index ) =>
  {
    const row = document.createElement( "tr" );

    // Calculate total price
    const totalPrice = ( quantities[ index ] * product.price ).toFixed( 2 );

    row.innerHTML = `
      <td>${ product.name }</td>
      <td>$${ product.price.toFixed( 2 ) }</td>
      <td>${ product.description }</td>
      <td>${ product.category }</td>
      <td>
        <div class="quantity-controls">
          <button onclick="adjustQuantity(${ index }, -1)">-</button>
          <span>${ quantities[ index ] }</span>
          <button onclick="adjustQuantity(${ index }, 1)">+</button>
        </div>
      </td>
      <td>$${ totalPrice }</td>
      <td><button class="order-button" onclick="placeOrder(${ index })">Order</button></td>
    `;

    tableBody.appendChild( row );
  } );
}

// Function to adjust quantity
function adjustQuantity ( index, change )
{
  // Update the quantity
  quantities[ index ] += change;

  // Ensure quantity doesn't go below 0
  if ( quantities[ index ] < 0 ) quantities[ index ] = 0;

  // Re-render the table to reflect the changes
  renderTable();
}

// Function to place an order
async function placeOrder ( index )
{
  const product = products[ index ];
  const quantity = quantities[ index ];
  console.log(product)
  console.log(quantity)

  if ( quantity > 0 )
  {
    // Prepare the order data
    const orderData = {
      product_id: product.product_id,
      quantity: quantity,
      price: product.price,
    };

    try
    {
      // Send a POST request to the backend API
      const response = await fetch( "http://localhost:8000/backend/api/orders", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify( orderData ),
      } );

      if ( !response.ok ) throw new Error( "Failed to place order" );

      socket.send( JSON.stringify( {
        type: "order",
        data: orderData
      } ) );

      const result = await response.json();
      alert( result.message );
    } catch ( error )
    {
      console.error( "Error placing order:", error );
      alert( "Failed to place order. Please try again." );
    }
  } else
  {
    alert( "Please select a quantity greater than 0." );
  }
}

// Function to initialize the app
async function initializeApp ( city )
{
  // Fetch products based on city temperature
  products = await fetchProductsByCity( city );

  // Initialize quantities array
  quantities = new Array( products.length ).fill( 0 );

  // Render the table
  renderTable();
}

initializeApp( "cairo" );