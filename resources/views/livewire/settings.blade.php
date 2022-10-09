<div>
   <div class="card">
       <div class="card-header">
           Select here the input fields for the form where you request information for your new contact.
       </div>
       <div class="card-body">

           <label class="d-flex align-items-center">
               <div class="form-check form-switch">
                   <input class="form-check-input"
                          value="1"
                          name="is_public"
                          type="checkbox"
                          id="flexSwitchCheckDefault"
                          class="my-3"
                          @if(Auth()->user()->member->settings->name == 1) checked @endif
                          wire:click="toggleName">
               </div>
               <h5 class="mb-1 ms-3">Name</h5>
           </label>

           <label class="d-flex align-items-center">
               <div class="form-check form-switch">
                   <input class="form-check-input"
                          value="1"
                          name="is_public"
                          type="checkbox"
                          id="flexSwitchCheckDefault"
                          class="my-3"
                          @if(Auth()->user()->member->settings->email == 1) checked @endif
                          wire:click="toggleEmail">
               </div>
               <h5 class="mb-1 ms-3">Email</h5>
           </label>

           <label class="d-flex align-items-center">
               <div class="form-check form-switch">
                   <input class="form-check-input"
                          value="1"
                          name="is_public"
                          type="checkbox"
                          id="flexSwitchCheckDefault"
                          class="my-3"
                          @if(Auth()->user()->member->settings->phone == 1) checked @endif
                          wire:click="togglePhone">
               </div>
               <h5 class="mb-1 ms-3">Phone</h5>
           </label>

           <label class="d-flex align-items-center">
               <div class="form-check form-switch">
                   <input class="form-check-input"
                          value="1"
                          name="is_public"
                          type="checkbox"
                          id="flexSwitchCheckDefault"
                          class="my-3"
                          @if(Auth()->user()->member->settings->notes == 1) checked @endif
                          wire:click="toggleNotes">
               </div>
               <h5 class="mb-1 ms-3">Notes</h5>
           </label>

           <label class="d-flex align-items-center">
               <div class="form-check form-switch">
                   <input class="form-check-input"
                          value="1"
                          name="is_public"
                          type="checkbox"
                          id="flexSwitchCheckDefault"
                          class="my-3"
                          @if(Auth()->user()->member->settings->company == 1) checked @endif
                          wire:click="toggleCompany">
               </div>
               <h5 class="mb-1 ms-3">Company</h5>
           </label>

           <label class="d-flex align-items-center">
               <div class="form-check form-switch">
                   <input class="form-check-input"
                          value="1"
                          name="is_public"
                          type="checkbox"
                          id="flexSwitchCheckDefault"
                          class="my-3"
                          @if(Auth()->user()->member->settings->VAT == 1) checked @endif
                          wire:click="toggleVAT">
               </div>
               <h5 class="mb-1 ms-3">VAT</h5>
           </label>

       </div>
   </div>
</div>
