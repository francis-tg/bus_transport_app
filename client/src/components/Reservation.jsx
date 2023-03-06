import React from "react";
import {useNavigate} from "react-router-dom";
import ImgRes from "../img/loginbg.jpg";
import {checkBeforeLaunch} from "../lib/checks";
function Reservation({data}) {
  const navigate = useNavigate();
  function reserve() {
    if (!checkBeforeLaunch()) {
      return navigate("/login");
    }
    return navigate("/order/" + data.id);
  }
  return (
    <div className='card lg:w-96 md:w-48 sm:w-24 w-full h-96 bg-base-100 shadow-xl'>
      <figure>
        <img src={ImgRes} alt='Shoes' />
      </figure>
      <div className='card-body'>
        <h2 className='card-title'>
          {data.leave_ville} - {data.dest_ville}
          <div className='badge badge-secondary'>{data.prix} f</div>
        </h2>
        <p>Le depart est la gare principale de Kara-sud</p>
        <div className='card-actions justify-end'>
          {/* <div className='badge badge-outline'></div> */}
          <div className='btn btn-secondary btn-sm' onClick={reserve}>
            Reserver
          </div>
        </div>
      </div>
    </div>
  );
}

export default Reservation;
