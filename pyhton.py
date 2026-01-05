import pandas as pd
data = {
    # "Name": ["Ismail", "Ali", "Sara"],
    "Marks": [85, 90, 88],
    "Department": ["Math", "Science", "Math"]
}

df = pd.DataFrame(data)
print(df)
print(df.groupby("Department").mean())
print(df.groupby("Department")["Marks"].max())
