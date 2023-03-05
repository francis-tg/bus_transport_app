import React from "react";
import DatalistInput from "react-datalist-input";

function Heroes() {
  const [depart, setDepart] = React.useState([]);
  const [arrive, setArrive] = React.useState([]);
  const [ticket, setTicket] = React.useState({
    leave: "",
    dest: "",
    dateDepart: ""
  });
  console.log(ticket);
  async function fecthDepartData() {
    await fetch(
      `${window.location.protocol}//${window.location.hostname}:86/api/get-depart`,
      {
        method: "GET"
      }
    )
      .then(async (response) => {
        if (response.status === 200) {
          const data = await response.json();
          const fdata = [];
          for (const key in data) {
            if (Object.hasOwnProperty.call(data, key)) {
              const element = data[key];
              fdata.push({
                id: element.id,
                value: element.leave_ville
              });
              setDepart(fdata);
            }
          }
        }
      })
      .catch((err) => console.log(err));
  }
  async function fecthDestData() {
    await fetch(
      `${window.location.protocol}//${window.location.hostname}:86/api/get-arrive`,
      {
        method: "GET"
      }
    )
      .then(async (response) => {
        if (response.status === 200) {
          const data = await response.json();
          const fdata = [];
          for (const key in data) {
            if (Object.hasOwnProperty.call(data, key)) {
              const element = data[key];
              fdata.push({
                id: element.id,
                value: element.dest_ville
              });
              setArrive(fdata);
            }
          }
        }
      })
      .catch((err) => console.log(err));
  }
  React.useEffect(() => {
    fecthDepartData();
    fecthDestData();
    return () => {};
  }, []);

  return (
    <div className='hero min-h-screen bg-base-200'>
      <div className='hero-content flex-col lg:flex-row'>
        <div className='text-center w-1/2 lg:text-left'>
          <h1 className='text-5xl font-bold'>Reserver maintenant!</h1>
          <p className='py-6'>
            Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda
            excepturi exercitationem quasi. In deleniti eaque aut repudiandae et
            a id nisi.
          </p>
        </div>
        <div className='card flex-shrink-0 w-full lg:max-w-lg max-w-sm shadow-2xl bg-base-100'>
          <div className='card-body'>
            <h2 className='text-3xl text-center'>Reserver dès maintenant</h2>
            <DatalistInput
              placeholder='Chocolate'
              label='Ville de départ'
              inputProps={{className: "input input-bordered"}}
              onSelect={(item) =>
                setTicket((prevState) => ({
                  ...prevState,
                  leave: item.id
                }))
              }
              items={depart}
            />

            <DatalistInput
              placeholder='Chocolate'
              label='Destination'
              inputProps={{className: "input input-bordered"}}
              onSelect={(item) =>
                setTicket((prevState) => ({
                  ...prevState,
                  dest: item.id
                }))
              }
              items={arrive}
            />
            <div className='form-control'>
              <label>Date de départ</label>
              <input
                type='datetime-local'
                placeholder='Date de départ'
                className='input input-bordered w-full max-w-xs lg:max-w-full'
                onChange={(e) => {
                  setTicket((prevState) => ({
                    ...prevState,
                    dateDepart: e.target.value
                  }));
                }}
              />
            </div>
            <div className='form-control mt-6'>
              <button className='btn btn-primary'>Reserver</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}

export default Heroes;
