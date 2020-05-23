
import React, { Component } from "react";
import ReactDOM from "react-dom"
import axios from "axios"
import Swal from 'sweetalert2'
import {sum} from 'lodash'

class Cart extends Component{
    constructor(props){
        super(props)
        this.state={
            cart: [],
            barcode: '',
        };
         
        this.loadCart = this.loadCart.bind(this);
        this.handleOnChangeBarcode = this.handleOnChangeBarcode.bind(this);
        this.handleScanBarcode =this.handleScanBarcode.bind(this);
        this.handleChangeQty = this.handleChangeQty.bind(this);
        
    }


    componentDidMount(){
        this.loadCart();
    }

    handleOnChangeBarcode(event){
        const barcode = event.target.value;
        console.log(barcode);
        this.setState({barcode})
    }

    loadCart(){
        axios.get('/admin/cart').then(res => {
            const cart = res.data;
            this.setState({cart})
        })
    }

    handleScanBarcode(event){
        event.preventDefault();
        const {barcode} = this.state;
        if(!! barcode){
            axios.post('/admin/cart',{barcode}).then(res => {
                this.loadCart();
                this.setState({barcode: ''})
            }).catch(err => {
                Swal.fire(
                    'Error!',
                    err.response.data.message,
                    'error'
                )
                console.log(err.response.data);
            })
        }
    }

    handleChangeQty(product_id,qty){
        const cart=this.state.cart.map(c => {
            if(c.id === product_id){
                c.pivot.quantity = qty;
            }
            return c;
        })
        this.setState({cart})
        axios.post('/admin/cart/change-qty',{product_id,quantity:qty}).then(res=>{

        }).catch(err => {
            Swal.fire(
                'Error!',
                err.response.data.message,
                'error'
            )
        })
    }

    getTotal(cart){
        const total =cart.map(c => c.pivot.quantity * c.price);
        return sum(total);
    }
    render(){
        const {cart, barcode} = this.state;
        return(
            <div className="row">
                 <div className="col-md-6 col-lg-4">
                <div className="row mb-2">
                    <div className="col">
                        <form onSubmit={this.handleScanBarcode}>
                            <input type="text" className="form-control" placeholder="Scan Barcode....."
                            value={barcode}
                            onChange={this.handleOnChangeBarcode}
                            />  
                        </form>
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
                        {cart.map(c => (
                            <tr key={c.id}>
                                <td>{c.name}</td>
                                <td>
                                <input type="text" className="form-control form-control-sm qty"
                                 value={c.pivot.quantity} 
                                 onChange={event => this.handleChangeQty(c.id, event.target.value)}/>
                                <button className="btn btn-danger btn-sm">
                                    <i className="fas fa-trash"></i>
                                </button>
                                </td>
                                 <td className="text-right">$ {(c.price * c.pivot.quantity).toFixed(2)}</td>
                             </tr>                           
                        ))} 
                          </tbody>
                        </table>
                    </div>
                    <div className="row">
                        <div className="col">
                            Total
                        </div>
                        <div className="col text-right">
                            $ {this.getTotal(cart)}
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


