import{u as m,o as d,c as l,w as t,a as o,b as a,H as c,d as e,e as u,n as f,f as p}from"./app.01e1887d.js";import{_}from"./GuestLayout.a1497c0e.js";import{_ as w,a as b,b as h}from"./TextInput.f37dc583.js";import{_ as x}from"./PrimaryButton.bf7206c3.js";import"./ApplicationLogo.7701e465.js";const g=e("div",{class:"mb-4 text-sm text-gray-600"}," This is a secure area of the application. Please confirm your password before continuing. ",-1),V=["onSubmit"],v={class:"flex justify-end mt-4"},F={__name:"ConfirmPassword",setup(y){const s=m({password:""}),i=()=>{s.post(route("password.confirm"),{onFinish:()=>s.reset()})};return(C,r)=>(d(),l(_,null,{default:t(()=>[o(a(c),{title:"Confirm Password"}),g,e("form",{onSubmit:p(i,["prevent"])},[e("div",null,[o(w,{for:"password",value:"Password"}),o(b,{id:"password",type:"password",class:"mt-1 block w-full",modelValue:a(s).password,"onUpdate:modelValue":r[0]||(r[0]=n=>a(s).password=n),required:"",autocomplete:"current-password",autofocus:""},null,8,["modelValue"]),o(h,{class:"mt-2",message:a(s).errors.password},null,8,["message"])]),e("div",v,[o(x,{class:f(["ml-4",{"opacity-25":a(s).processing}]),disabled:a(s).processing},{default:t(()=>[u(" Confirm ")]),_:1},8,["class","disabled"])])],40,V)]),_:1}))}};export{F as default};
