// let endpoint = 'http://localhost/ElgadiSalma_Alpha/Users/'

// const pubContainer = document.getElementById('pubContainer');

// fetch(endpoint+`displayAll`)
//     .then(response => response.json())
//     .then(data => {
//       // publication = data;

//       displayData(data);
//     })
//     .catch(error => {
//       console.error('Error:', error);
//     });


// function displayData(data)
// {
//     // console.log(pubContainer);
//     const rows = data.map((pub) => {
        
//         return (
//      `
//         <div class="px-5 py-3 text-center flex flex-col   ">
//             <h3 class="text-black uppercase text-2xl font-bold  ">${pub.username}</h3>
//             <div>
//                 <span class=" mt-2 text-blue-500 font-bold p-2 " id="priceInput" >${pub.price} DH </span>
//             </div>
//             <div>
//                 <span class="float-right p-2 text-gray-400 ">${pub.created_by}</span>
//             </div>     
//         </div>  
//      `
//         );
//       });
//       console.log(rows);
//       pubContainer.innerHTML = rows;
//   }


// function addUser()
// {
//     const usernameInput = document.getElementById('username').value.trim();
//     const emailInput = document.getElementById('email').value.trim();
//     const passwordInput = document.getElementById('password').value.trim();

//     const pubData = 
//     {
//       username: usernameInput,
//       email: emailInput,
//       created_by: passwordInput,
//     };

//     if (usernameInput !== '' && emailInput !=='' && passwordInput !=='') 
//     {
//       fetch(endpoint+`addPub`, {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//         },
//         body: JSON.stringify(pubData),
//         })

//         .then(response => response.json())
//         .then(data => {
//           // console.log(data);
//           if (data.message) {
//             fetch(endpoint+`displayAll`)
//             .then(response => response.json())
//             .then(data => {
//               // publication = data;

//               displayData(data);
//             })
//             .catch(error => {
//               console.error('Error:', error);
//             });


//           }
//         })
          
//         .catch(error => {
//           console.error('Erreur', error);
//         });
//     }
// }