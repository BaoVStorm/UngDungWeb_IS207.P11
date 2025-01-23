import pandas as pd

input_path = r"D:\Homework\Year3\UngDungWeb_IS207.P11\DoAn\CSV\Pot_AllAttribute_.csv"
output_path = r"D:\Homework\Year3\UngDungWeb_IS207.P11\DoAn\CSV"

df_id = pd.read_csv(input_path)

id_attribute = 13

df_id["id_attribute"] = 0

def getId():
    global id_attribute
    attribute_id = f"CCNATT{id_attribute:04d}"
    id_attribute += 1
    return attribute_id

for i in range(len(df_id)):
    df_id.at[i, "id_attribute"] = getId()
    print(df_id["id_attribute"][i])

df_id.to_csv(output_path + rf"\Pot_AllAttribute.csv", index=False, encoding="utf-8-sig")

print("Save successfully")