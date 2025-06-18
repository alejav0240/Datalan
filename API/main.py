from fastapi import FastAPI
from pydantic import BaseModel
import joblib
import pandas as pd

# Cargar modelo y encoder
modelo = joblib.load('modelo_regresion.pkl')
encoder = joblib.load('encoder_categorias.pkl')

app = FastAPI()

class Trabajo(BaseModel):
    cantidad_empleados: int
    cant_tipo_trabajo: int
    cant_prioridad: int
    tipo_trabajo: str
    prioridad: str

@app.post("/predecir-tiempo")
def predecir(trabajo: Trabajo):
    df = pd.DataFrame([trabajo.dict()])

    # Codificar variables categóricas
    encoded = encoder.transform(df[['tipo_trabajo', 'prioridad']])
    df_encoded = pd.DataFrame(
        encoded, columns=encoder.get_feature_names_out(['tipo_trabajo', 'prioridad'])
    )

    # Unir con datos numéricos
    X = pd.concat([
        df[['cantidad_empleados', 'cant_tipo_trabajo', 'cant_prioridad']].reset_index(drop=True),
        df_encoded.reset_index(drop=True)
    ], axis=1)

    # Predecir
    tiempo_estimado = modelo.predict(X)[0]
    return {"tiempo_resolucion_estimado": round(tiempo_estimado, 2)}
