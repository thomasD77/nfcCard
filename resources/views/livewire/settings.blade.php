<div>
   <div class="card">
       <div class="card-header">
           Mark the information you want to display on your SWAP form to get information.
       </div>
       <div class="card-body">

           <label class="d-flex align-items-center">
               <input type="checkbox"
                      @if(Auth()->user()->member->settings->name == 1) checked @endif
                      class="btn btn-sm btn-alt-secondary"
                      wire:click="toggleName"
                      value="1"
               >
               <h5 class="mb-1 ms-3">Name</h5>
           </label>

           <label class="d-flex align-items-center">
               <input type="checkbox"
                      @if(Auth()->user()->member->settings->email == 1) checked @endif
                      class="btn btn-sm btn-alt-secondary"
                      wire:click="toggleEmail"
                      value="1"
               >
               <h5 class="mb-1 ms-3">Email</h5>
           </label>

           <label class="d-flex align-items-center">
               <input type="checkbox"
                      @if(Auth()->user()->member->settings->phone == 1) checked @endif
                      class="btn btn-sm btn-alt-secondary"
                      wire:click="togglePhone"
                      value="1"
               >
               <h5 class="mb-1 ms-3">Phone</h5>
           </label>

           <label class="d-flex align-items-center">
               <input type="checkbox"
                      @if(Auth()->user()->member->settings->notes == 1) checked @endif
                      class="btn btn-sm btn-alt-secondary"
                      wire:click="toggleNotes"
                      value="1"
               >
               <h5 class="mb-1 ms-3">Notes</h5>
           </label>

           <label class="d-flex align-items-center">
               <input type="checkbox"
                      @if(Auth()->user()->member->settings->company == 1) checked @endif
                      class="btn btn-sm btn-alt-secondary"
                      wire:click="toggleCompany"
                      value="1"
               >
               <h5 class="mb-1 ms-3">Company</h5>
           </label>

           <label class="d-flex align-items-center">
               <input type="checkbox"
                      @if(Auth()->user()->member->settings->VAT == 1) checked @endif
                      class="btn btn-sm btn-alt-secondary"
                      wire:click="toggleVAT"
                      value="1"
               >
               <h5 class="mb-1 ms-3">VAT</h5>
           </label>

       </div>
   </div>
</div>