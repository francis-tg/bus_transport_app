import React from "react";
import {useParams} from "react-router-dom";
import {toast} from "react-toastify";

function Order() {
  const params = useParams();
  const [userData, setData] = React.useState([]);
  const [getTrajet, setTrajet] = React.useState([]);
  const [payement, setPayement] = React.useState({
    account: "",
    amount: ""
  });
  async function getOneTrajet() {
    await fetch(
      `${window.location.protocol}//${window.location.hostname}:86/api/trajet?id=${params.id}`,
      {
        method: "GET"
      }
    )
      .then(async (response) => {
        if (response.status === 200) {
          const data = await response.json();
          setTrajet(JSON.parse(data));
          console.log(data);
          setPayement((prevState) => ({
            ...prevState,
            amount: getTrajet["prix"]
          }));
        }
      })
      .catch((err) => toast.error("Une erreur est survenue..."));
  }
  React.useEffect(() => {
    setData(JSON.parse(sessionStorage.getItem("userData"))[1]);
    getOneTrajet();
  }, []);

  function onChange(e) {
    setPayement((prevState) => ({
      ...prevState,
      [e.target.id]: e.target.value
    }));
  }

  return (
    <section className='bg-base-200'>
      <div className='container  p-5'>
        <div className='flex'>
          <div className='card py-3 w-1/2'>
            <div className='card-title'>
              <h1 className='text-3xl font-bold'>Trajet</h1>
            </div>
            <div className='card-body'>
              <h1 className='text-2xl font-semibold'>Yaoundé - Douala</h1>

              <p>Nom: {userData.nom}</p>
              <p>Contact: {userData.phone}</p>
            </div>
          </div>
          <div className='py-3'>
            <div className='text-3xl font-semibold mb-3'>Mode payement</div>
            <div className='form-control'>
              <label>Numero de compte</label>
              <input
                className='input input-bordered'
                id='account'
                onChange={onChange}></input>
            </div>
            <div className='form-control'>
              <label>Montant</label>
              <input
                className='input input-bordered'
                id='amount'
                readOnly
                value={payement.amount}></input>
            </div>
            <div className='form-control'>
              <label>Code Pin</label>
              <input
                type='tel'
                className='input input-bordered'
                id='pin'
                onChange={onChange}></input>
            </div>
            <button className='btn mt-3 w-full'>Payer</button>
          </div>
        </div>
      </div>
    </section>
  );
}

export default Order;
