//state
const getDefaultState = () => 
{
    return {      
        loaded:false,    
        tahun_data:new Date().getFullYear(),  
        identitas:{
            nama_app:'',
            nama_app_alias:''
        },  
    }
}
const state = getDefaultState();

//mutations
const mutations = {
    setLoaded(state,loaded)
    {
        state.loaded=loaded;
    },    
    setTahunData(state,tahun)
    {
        state.tahun_data = tahun;
    },    
    setIdentitas(state,identitas)
    {
        state.identitas = identitas;
    },    
    resetState (state) {
        Object.assign(state, getDefaultState())
    }
}
const getters= {
    isLoaded : state => {
        return state.loaded;
    },    
    getTahunData: state => 
    {             
        return state.tahun_data;
    },
    getNamaAPP: state => 
    {             
        return state.identitas.nama_app;
    },    
    getNamaAPPAlias: state => 
    {
        return state.identitas.nama_app_alias;
    },
}
const actions = {
    init: async function ({commit,state},ajax)
    {        
        //dipindahkan kesini karena ada beberapa kasus yang melaporkan ini membuat bermasalah.
        commit('setLoaded',false);              
        if (!state.loaded)
        {            
            await ajax.get('/system/setting/uifront').then(({data})=>{                  
                commit('setTahunData',data.tahun_data);                                                                                            
                commit('setIdentitas',data.identitas);                                                         
                commit('setLoaded',true);
            })
        }
    },
    reinit ({ commit }) 
    {
        commit('resetState');
    },
}
export default {
    namespaced: true,
    state,  
    mutations,
    getters,
    actions
}