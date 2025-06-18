import sys
import pandas as pd
import joblib

# Cargar modelo y encoder
modelo = joblib.load('modelo_regresion.pkl')
encoder = joblib.load('encoder_categorias.pkl')

# Capturar argumentos desde PHP (en orden)
cantidad_empleados = int(sys.argv[1])
cant_tipo_trabajo = int(sys.argv[2])
cant_prioridad = int(sys.argv[3])
tipo_trabajo = sys.argv[4]
prioridad = sys.argv[5]

# Crear DataFrame
df = pd.DataFrame([{
    'cantidad_empleados': cantidad_empleados,
    'cant_tipo_trabajo': cant_tipo_trabajo,
    'cant_prioridad': cant_prioridad,
    'tipo_trabajo': tipo_trabajo,
    'prioridad': prioridad
}])

# Codificar categóricas
encoded = encoder.transform(df[['tipo_trabajo', 'prioridad']])
df_encoded = pd.DataFrame(encoded, columns=encoder.get_feature_names_out(['tipo_trabajo', 'prioridad']))

# Combinar
X = pd.concat([
    df[['cantidad_empleados', 'cant_tipo_trabajo', 'cant_prioridad']].reset_index(drop=True),
    df_encoded.reset_index(drop=True)
], axis=1)

# Predecir
tiempo = modelo.predict(X)[0]
print(round(tiempo, 2))  # Solo imprime el resultado
