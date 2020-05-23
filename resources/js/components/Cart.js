
import React, { Component } from "react";
import ReactDOM from "react-dom"
import axios from "axios"


class Cart extends Component{
    constructor(props){
        super(props)
        this.state={
            cart: [],
        };
         
        this.loadCart = this.loadCart.bind(this);
    }

    componentDidMount(){
        this.loadCart();
    }

    renderCart() {
        return this.state.cart.map(c => {
            return (
                <tr>
                <td>{c.name}</td>
                <td>
                    <input type="text" className="form-control form-control-sm qty" value={c.pivot.quantity}/>
                    <button className="btn btn-danger btn-sm">
                        <i className="fas fa-trash"></i>
                    </button>
                </td>
                 <td className="text-right">$ {(c.price * c.pivot.quantity).toFixed(2)}</td>
            </tr>
            );
        })
    }

    loadCart(){
        axios.get('/admin/cart').then(res => {
            const cart = res.data;
            this.setState({cart})
        })
    }
    render(){
        return(
            <div className="row">
                 <div className="col-md-6 col-lg-4">
                <div className="row mb-2">
                    <div className="col">
                        <input type="text" className="form-control" placeholder="Scan Barcode....."/>
                    </div>
                    <div className="col">
                        <select name="" id="" className="form-control">
                            <option value="">walking customer</option>
                        </select>
                    </div>
                </div>
                <div className="user-cart">
                    <div className="card">
                        <table className="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th className="text-right">Price</th>
                                </tr>
                            </thead>
                            <tbody>
                            {this.renderCart()}
                            </tbody>
                        </table>
                    </div>
                    <div className="row">
                        <div className="col">
                            Total
                        </div>
                        <div className="col text-right">
                            500
                        </div>
                    </div>
                     <div className="row mb-2">
                        <div className="col ">
                            <button type="button" className="btn btn-danger btn-block">Cancel</button>
                        </div>
                        <div className="col">
                            <button type="button" className="btn btn-success btn-block">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
            <div className="col-md-6 col-lg-8">
                <div className="mb-2">
                    <input type="text" className="input form-control" placeholder="Search Product ... "/>
                </div>
                <div className="order-product">
                    <div className="item">
                        <img src="http://localhost:8000/storage/1/coca.jpg" alt=".." />
                        <h5>Coca</h5>
                    </div>
                </div>
            </div>
        </div>
        );
    }
}

export default Cart;
// cart this is name id of div in index page of cart

if (document.getElementById("cart")) {
    ReactDOM.render(<Cart />, document.getElementById("cart"));
}
